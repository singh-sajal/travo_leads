<?php

namespace App\Traits;

use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Foundation\Http\FormRequest;

trait ImageUpload
{
    public function Crop($file, $w, $h, $location, $ratio = false)
    {
        // Create path if not exist
        if (!is_dir($location)) {
            mkdir($location, 0755, true);
        }

        $filename =  uniqid() . '.' . $file->extension();
        $path = public_path($location) . $filename;
        // SVG image move to location
        if ($file->extension() == 'svg') {
            $file->move(public_path($location), $filename);
            return $location . $filename;
        }
        // $image = Image::make($file);
        $image = Image::read($file);
        if ($ratio == false)
            $image->resize($w, $h);
        else {
            if ($image->getWidth() > $image->getHeight())
                $h = 'auto';
            else
                $w = 'auto';
            $image->resize($w, $h, function ($c) {
                $c->aspectRatio();
                // $c->upsize();
            });
        }


        if ($image->save($path, 100))
            return $location . $filename;
        else '';
    }

    public function ImgDel($img)
    {
        if (!empty($img)) {
            $img = str_replace(asset(''), '', $img);
            if (file_exists(public_path($img)))
                unlink(public_path($img));
        }
    }
}
