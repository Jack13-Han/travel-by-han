<?php

namespace App\Classes;

use Illuminate\Support\Facades\Request;

class FileControl
{
    public static function fileSave($inputName,$storeDir=""){
        $dir="public/".$storeDir;

        $newName = $inputName."_".uniqid().".".request()->file($inputName)->extension();
        request()->file($inputName)->storeAs($dir,$newName);
        return $newName;
    }
}
