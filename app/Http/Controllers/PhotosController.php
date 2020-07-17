<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PhotosController extends Controller
{
    public function uploadPhoto(Request $request)
    {
        $file = $request->file;
        $category=$request->category;
        $extension = $file->getClientOriginalExtension(); // getting image extension
        $filename =str_random(25).'.'.$extension;
        $file->move(public_path().DIRECTORY_SEPARATOR.$category, $filename);
        $photo=new Photo();
        $photo->name=$filename;
        $photo->categories=$category;
        $photo->path=DIRECTORY_SEPARATOR.$category.DIRECTORY_SEPARATOR.$filename;
        $photo->save();
        return response()->json($photo, 200);
    }
    public function removePhoto(Request $request)
    {
        $photo_id=$request->photo_id;
        $photo=Photo::find($photo_id);
        File::delete(public_path().DIRECTORY_SEPARATOR.$photo->path);
        Photo::find($photo_id)->delete();
        return response()->json(['message'=>'Photo Deleted Successfully','status'=>'true']);
    }
}
