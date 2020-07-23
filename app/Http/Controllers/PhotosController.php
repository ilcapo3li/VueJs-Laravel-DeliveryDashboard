<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PhotosController extends Controller
{
    public function uploadFile(Request $request)
    {
        $file = $request->file;
        $category = $request->category;
        $extension = $file->getClientOriginalExtension(); // getting image extension
        $filename = str_random(25).'.'.$extension;
        $path = 'public'.DIRECTORY_SEPARATOR.$category.DIRECTORY_SEPARATOR.$filename;
        $file->storeAs('public'.DIRECTORY_SEPARATOR.$category, $filename);
        $photo = new Photo();
        $photo->name = $filename;
        $photo->categories = $category;
        $photo->path = DIRECTORY_SEPARATOR.$category.DIRECTORY_SEPARATOR.$filename;
        $photo->save();

        return response()->json($photo->id, 200);
    }

    public function removeFile(Photo $photo)
    {
        if (File::delete(public_path().DIRECTORY_SEPARATOR.$photo->path) && $photo->delete()) {
            return response()->json(['message' => 'Photo Deleted Successfully', 'status' => 'true']);
        } else {
            return response()->json(['message' => 'Erorr In Deleting Photo ', 'status' => 'false']);
        }
    }
}
