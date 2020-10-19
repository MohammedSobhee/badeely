<?php

namespace App\Classes;

use Image;

class Media
{

    public function upload($file, $folder, $sizes)
    {
        $isBase64 = is_string($file);

        if($file){

            if(!$isBase64){
                $ext= '.'.$file->getClientOriginalExtension();
                $img = Image::make($file);
                $name = uniqid().time();
                $path = 'assets/images/'.$folder.'/';
            }else{

//                list($type, $file) = explode(';', $file);
//                list(, $file)      = explode(',', $file);
                $ext = '.jpg';

                $img = Image::make(base64_decode($file));
                $name = uniqid().time();
                $path = 'assets/images/'.$folder.'/';
            }

            if($sizes){
                foreach ($sizes as $size){

                    if($size['x'] || $size['y']){
                        $img->resize($size['x'],$size['y']);
                        $img_path = base_path($path.$size['x'].'_'.$size['y'].'_'.$name.$ext);
                    }else{
                        $img_path = base_path($path.$name.$ext);
                    }

                    $img->save($img_path);

                    if($size[0]){
                        $this->compress_image($img_path, 50);
                    }

                }
            }

            return $name.$ext;

         }

       return null;

    }

//    public function base64Upload($file, $folder)
//    {
//
//        return
//    }

    public function video($file)
    {
        try{
                $ext= $file->getClientOriginalExtension();
                $filename = uniqid().time();
                $filename = $filename.'.'.$ext;

                $file->move(base_path('assets/videos/'), $filename);

        }catch (\Exception $ex){
           //throw exception
        }

        return $filename;

    }

    public function url($folder,$fileName)
    {
        $path = 'assets/images/' . $folder . '/' . $fileName;

        if(!is_file($path))
        {
            return url('assets/images/no-file.png');
        }

        return url($path);
    }

    public function videoUrl($fileName)
    {
        if(!$fileName)
        {
            return url('assets/images/no-file.svg');
        }

        return url('assets/videos/' . $fileName);
    }

    public function destroy($model,$filename)
    {
        $filename = base_path('assets/images/' . $model . '/' . $filename);
        if (is_file($filename)) {
            unlink($filename);
        }
    }

    public function compress_image($source_url)
    {
//        $info = getimagesize($source_url);
//
//        if ($info['mime'] == 'image/jpeg'){
//
//            $image = imagecreatefromjpeg($source_url);
//            imagejpeg($image, $source_url, 75);
//
//        }elseif ($info['mime'] == 'image/gif') {
//
//            $image = imagecreatefromgif($source_url);
//            imagegif($image, $source_url, 75);
//        }
//        }elseif ($info['mime'] == 'image/png'){
//
//            $image = imagecreatefrompng($source_url);
//            imagepng($image, $source_url, 5);
//
//        }

        return $source_url;
    }

}