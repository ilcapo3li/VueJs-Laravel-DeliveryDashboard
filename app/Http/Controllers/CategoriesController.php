<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Validator;

use App\Http\Resources\CategoriesCollection;
use App\Helpers\PhotoHelper;

class CategoriesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (Category::orderBy('rank', 'desc')->orderBy('id', 'desc')->get());
    }


    public function getCategories()
    {
        return new CategoriesCollection(Category::orderBy('rank', 'desc')->orderBy('id', 'desc')->paginate(10));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    public function saveCategories(Request $request)
    {
        $validator=Validator::make($request->all(), [
            'category_name'=>'required|unique:categories,en_name',
            'category_en_name'=>'required|unique:categories,ar_name',
            'category_rank'=>'integer'
            
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        } else {
            $categories = new Category();
            $categories->en_name = $request->category_en_name;
            $categories->ar_name = $request->category_name;
            $categories->discription = $request->category_discription;
            $categories->status = $request->category_status;
            $categories->photo_id = $request->logo;
            $categories->rank = $request->category_rank;
            $categories->save();
            return response()->json(['message'=>'Category Saved Successfully','status'=>'true']);
        }
    }
    public function updateCategories(Request $request, $id)
    {
        $validator=Validator::make($request->all(), [
            'category_name'=>'required|unique:categories,en_name,'.$id,
            'category_en_name'=>'required|unique:categories,ar_name,'.$id,
            'category_rank'=>'integer'

        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        } else {
            $categories = Category::find($id);
            $categories->en_name = $request->category_en_name;
            $categories->ar_name = $request->category_name;
            $categories->discription = $request->category_discription;
            $categories->status = $request->category_status;
            $categories->photo_id = $request->logo;
            $categories->rank = $request->categories_rank;
            $categories->save();
            return response()->json(['message'=>'Category Updated Successfully','status'=>'true']);
        }
    }
    public function deleteCategories(Request $request)
    {
        $validator=Validator::make($request->all(), [
            'category_id'=>'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        } else {
            $category = Category::find($request->category_id);
            $category->photo()->delete();
            $category->channels()->delete();
            $category->delete();
            return response()->json(['message'=>'Category Deleted Successfully','status'=>'true']);
        }
    }
}
