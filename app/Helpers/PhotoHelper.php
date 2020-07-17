<?php

namespace App\Helpers;

use App\Photo;

class PhotoHelper{

    public function constructPhoto($photo,$type){
        $image = str_replace(' ', '+', $photo);
        $imageName = str_random(25).'.'.'jpg';
            \File::put(public_path().DIRECTORY_SEPARATOR.$type.DIRECTORY_SEPARATOR.$imageName, base64_decode($image));
            $photo= new Photo();
            $photo->name=$imageName;
            $photo->path=DIRECTORY_SEPARATOR.$type.DIRECTORY_SEPARATOR.$imageName;
            $photo->categories=$type;
            $photo->save();  
            return $photo->id;       
    }

    public static function Photo($photo,$type){
         $image = str_replace(' ', '+', $photo);
         $imageName = str_random(25).'.'.'jpg';
            
         Image::Make(base64_decode($image))->save(public_path().DIRECTORY_SEPARATOR.$type.DIRECTORY_SEPARATOR.$imageName);
            $photo= new Photo();
            $photo->name=$imageName;
            $photo->path=DIRECTORY_SEPARATOR.$type.DIRECTORY_SEPARATOR.$imageName;
            $photo->categories=$type;
            $photo->save();  
            return $photo->id;       
    }

}
