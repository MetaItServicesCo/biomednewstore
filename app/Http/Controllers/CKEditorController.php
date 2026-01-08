<?php

namespace App\Http\Controllers;

use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;

class CKEditorController extends Controller
{
    use UploadImageTrait;

    public function upload(Request $request)
    {
        // Directory can also be dynamic, based on optional param
        $directory = $request->get('dir', 'ckeditor');
        return $this->handleCKEditorUpload($request, $directory);
    }
}
