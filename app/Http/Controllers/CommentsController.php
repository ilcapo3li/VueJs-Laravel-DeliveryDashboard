<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Resources\CommentsCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator= Validator::make($request->all(), [
            'post_id'=>'required',
            'post_type'=>'required',
            'body'=>'required',
            
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {
            $comment= new Comment();
            $comment->user_id=Auth::id();
            $comment->comment = $request->body;
            $comment->commentable_id = $request->post_id;
            $comment->commentable_type = $request->post_type;
            $comment->save();
            return response()->json(['status'=>'true'], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * get the specified comments from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getcomments(Request $request)
    {
        $validator= Validator::make($request->all(), [
            'post_id'=>'required',
            'post_type'=>'required',
            

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {
            switch ($request->post_type) {
            case('news'):

            $comments= new CommentsCollection(Comment::where('news_post_id', $request->post_id)->paginate(10));
            $comments_number = Comment::where('news_post_id', $request->post_id)->count();
            return response()->json(['comments'=>$comments,'comments_number'=>$comments_number,'status'=>'OK'], 200);
            break;
            case('video'):
            $comments=  new CommentsCollection(Comment::where('video_id', $request->post_id)->paginate(10));
            $comments_number = Comment::where('video_id', $request->post_id)->count();
            return response()->json(['comments'=>$comments,'comments_number'=>$comments_number,'status'=>'OK'], 200);
            break;
            
            }
        }
    }
}
