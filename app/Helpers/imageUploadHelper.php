<?php
namespace App\Helpers;
use Illuminate\Support\Facades\URL;
class imageUploadHelper
{
    public static function uploadFileWithPath($file,$path){
        $fileName = $file->getClientOriginalName();
        $file->move($path,$fileName);
        $uploadPath = URL::to('/') . '/' . $path . '/' . $fileName;
        return $uploadPath;
    }
}