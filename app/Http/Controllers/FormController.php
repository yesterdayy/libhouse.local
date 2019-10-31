<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use App\Models\Forms\Form;
use App\Models\Forms\FormClients;
use App\Models\Forms\FormClientsInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use PHPMailer\PHPMailer\PHPMailer;

class FormController extends Controller
{

    public function submit(Request $request) {
        $data = $request->all();
        $form = Form::find($data['form_id']);

        if (!$form) {
            return false;
        }

        $result = [];

        $modal = [];
        if ($form->templates()->count() > 0) {
            foreach ($form->templates()->get()->toArray()[0] as $key => $item) {
                if (strpos($key, 'modal') !== false) {
                    $modal[str_replace('modal_', '', $key)] = $item;
                }
            }
        }

        $result = ['modal' => $modal];

        $form_name = $form->name;

        $fields = [];
        $html = '<h3>' . $form_name . '</h3>Контактные данные:';
        foreach ($data as $key => $item) {
            if (!in_array($key, ['personal', 'form_id', 'check'])) {
                $html .= '<p><b>' . $key . ':</b> ' . $item . '</p>';
                $fields[] = [
                    'field' => $key,
                    'value' => $item,
                ];
            }
        }

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'yesterdayy33@gmail.com';
        $mail->Password = '305lz.1xs';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        //Recipients
        $mail->setFrom('yesterdayy33@gmail.com', 'Mailer');
        $mail->addAddress('yesterdayy33@gmail.com', 'Joe User');
        $mail->Subject = "Subject Text";
        $mail->Body = $html;
        $mail->isHTML(true);

        if (count($request->allFiles()) > 0) {
            foreach ($request->allFiles() as $file) {
                $mail->addAttachment(Storage::disk('public')->path($file->store('mails', 'public')));
            }
        }

        if ($mail->send()) {
            if (isset($data['email']) && !empty($data['email'])) {
                $form_client = new FormClients();
                $form_client->email = $data['email'];
                $form_client->form_id = $form->id;
                $form_client->save();

                foreach ($fields as $k => $field) {
                    $fields[$k]['client_id'] = $form_client->id;
                }
                FormClientsInfo::insert($fields);
            }
        }

        return json_encode($result);
    }

}
