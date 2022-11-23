<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;



class UploadHelper
{
    /*
    * Helper untuk upload file
    */
    public function uploadFile($data) : string
    {
        $unique = md5(uniqid(rand(), true));
        $file = $data->getClientOriginalName();
        $filename = pathinfo($file, PATHINFO_FILENAME);
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        $attachment = $filename ."-" . substr($unique, 0, 5) . '.' . $extension;
        $data->move(public_path('attachment'), $attachment);
        return $attachment;
    }

    /*
    * Untuk delete file
    */
    public function removeFile(string $filename)
    {
        if (File::exists(public_path("attachment/$filename"))) {
            File::delete(public_path("attachment/$filename"));
        }
    }
}