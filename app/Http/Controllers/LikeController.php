<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use Illuminate\Support\Facades\Validator;
use Auth;


class LikeController extends Controller
{
   public function setLike(Request $request){
        $validator= Validator::make($request->all(),[
            'type_id'=>'required',
            'type'=>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }
        else{
            if(
                Like::where('user_id',Auth::id())->where('type_id',$request->type_id)
            ->where('type',$request->type)->first()
            )
            {
                return response()->json(['message'=>'Dublicated Entry','status'=>'false'],422);

            }
            else{
                $favourite= new Like();
                $favourite->user_id=Auth::id();
                $favourite->type_id=$request->type_id;
                $favourite->type=$request->type;
                $favourite->save();
                return response()->json(['message'=>'Like Set Successfully','status'=>'true'],200);
            }
           
        }
    }

public function destroyLike(Request $request){
        $validator= Validator::make($request->all(),[ 
            'type_id'=>'required',
            'type'=>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }
        else{
            if(
                Like::where('user_id',Auth::id())->where('type_id',$request->type_id)
            ->where('type',$request->type)->first()
            )
            {
                $like = Like::where('user_id',Auth::id())->where('type_id',$request->type_id)
            ->where('type',$request->type)->first()->delete();
                return response()->json(['message'=>'Like Delete Successfully','status'=>'true'],200);

            }
            else{
               
                return response()->json(['message'=>'Like Not Found','status'=>'false'],422);
            }
           
        }
    }


}
