<?php

namespace App\Http\Controllers;

use App\Models\Blog\Attachments;
use Illuminate\Http\Request;

class UploadController extends Controller
{

    public function admin_photo(Request $request, $without_thumbnails = false) {
        $result = Attachments::photoUpload($request, $without_thumbnails);

        // Фикс встроенной загрузки изображений
        // Через решетку отдаем id аттача
        $result = $result->toArray();
        $result['url'] .= '#' . $result['id'];

        return response()->json($result);
    }

    public function admin_avatar(Request $request) {
        $result = Attachments::avatarUpload($request);

        // Фикс встроенной загрузки изображений
        // Через решетку отдаем id аттача
        $result = $result->toArray();
        $result['url'] .= '#' . $result['id'];

        return response()->json($result);
    }

    public function photo(Request $request) {
        return $this->admin_photo($request);
    }

    public function photo_document(Request $request) {
        return $this->admin_photo($request, true);
    }

}
