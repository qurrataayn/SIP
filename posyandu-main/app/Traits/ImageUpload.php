<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

trait ImageUpload
{
    public function SaveImage($request, $lokasi)
    {
        $uploadPath  = $lokasi;
        $rand        = rand(000, 999);


        if ($request->hasFile('image')) {

            $name =  $rand . '_' . date('YmdHis') . '.' . $request->image->getClientOriginalName();

            $request->image->move($uploadPath, $name);
        } else {
            $name = null;
        }


        return $name;
    }

    public function UpdateImage($request, $lokasi, $old)
    {
        $uploadPath  = $lokasi;
        $rand        = rand(000, 999);

        if ($request->hasFile('image')) {

            $name =  $rand . '_' . date('YmdHis') . '.' . $request->image->getClientOriginalName();

            File::delete($uploadPath . $old);

            $request->image->move($uploadPath, $name);
        } else {
            $name = $old;
        }


        return $name;
    }
}
