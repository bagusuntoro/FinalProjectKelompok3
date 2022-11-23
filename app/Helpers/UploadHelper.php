<?php

namespace App\Helpers;



class UploadHelper
{
    /*
    * Helper untuk upload file
    */
    public function uploadFile($data) : string
    {
        $file = $data->getClientOriginalName();
        $filename = pathinfo($file, PATHINFO_FILENAME);
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        $attachment = $filename ."-" . time() . '.' . $extension;
        $data->move(public_path('attachment'), $attachment);
        return $attachment;
    }
}