<?php

namespace App\Http\Controllers\Filemanager;

use App\Models\Blog\Attachments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class FilemanagerController extends Controller
{

    private const DEFAULT_LIMIT = 20;

    public function get_files(Request $request) {
        error_reporting(E_ALL);
        $start = $request->get('start') ?? 0;
        $length = $request->get('length') ?? self::DEFAULT_LIMIT;
        $type = $request->get('type') ?? false;

        $files = Attachments::select(['id', 'name', 'extension', 'path', 'disk', 'mime', 'size', 'created_at'])->distinct()->orderBy('id', 'desc');

        if ($type) {
            switch ($type) {
                case 'image':
                    $files = $files->whereIn('mime', ['image/jpeg', 'image/png']);
            }
        }

        $files = $files->offset($start)->limit($length)->get()->toArray();
        foreach ($files as $k => $file) {
            unset($files[$k]['extension'], $files[$k]['path'], $files[$k]['disc']);
        }
        dd($files);
    }

}
