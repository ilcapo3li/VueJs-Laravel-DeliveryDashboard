<?php

namespace App\Http\Controllers;

use App\NewsPost;
use Auth;
use Illuminate\Http\Request;
use App\Http\Resources\NewsPostsCollection;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    public function index()
    {
        return new NewsPostsCollection(NewsPost::orderby('id', 'desc')->paginate(10));
    }

    public function saveNews(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required',
            'source_id' => 'required',
            'sport_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        } else {
            $news = new NewsPost();
            $news->title = $request->title;
            $news->body = $request->body;
            $news->trend = $request->trend;
            // $news->rank = $request->rank;
            $news->source_id = $request->source_id;
            $news->toranment_type_id = $request->sport_id;
            $news->user_id = Auth::id();
            $news->photo_id = $request->logo;
            $news->save();

            return response()->json(['message' => 'Post Created Successfully', 'status' => 'true']);
        }
    }

    public function updateNews(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required',
            'source_id' => 'required',
            'sport_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        } else {
            $news = NewsPost::find($id);
            $news->title = $request->title;
            $news->body = $request->body;
            $news->trend = $request->trend;
            // $news->rank = $request->rank;
            $news->source_id = $request->source_id;
            $news->toranment_type_id = $request->sport_id;
            $news->user_id = Auth()->user()->id;
            $news->photo_id = $request->logo;
            $news->trend = $request->trend;
            $news->save();

            return response()->json(['message' => 'Post Updated Successfully', 'status' => 'true']);
        }
    }

    public function deleteNews(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'news_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        } else {
            $news = NewsPost::find($request->news_id);
            // $news->postPhoto()->delete();
            $news->delete();

            return response()->json(['message' => 'Post Deleted Successfully', 'status' => 'true']);
        }
    }

    public function getNews()
    {
        $news = new NewsPostsCollection(NewsPost::orderby('id', 'desc')->paginate(10));
        $trended_news = new NewsPostsCollection(NewsPost::where('trend', 'trend')->orderby('id', 'desc')->paginate(10));

        return response()->json(['data' => ['news' => $news, 'trended_news' => $trended_news], 'status' => 'true', 'news' => NewsPost::orderby('id', 'desc')->paginate(10)]);
    }

    public function newsDetails(Request $request)
    {
        $news = new NewsPostsCollection(NewsPost::where('id', $request->news_id)->orderBy('id', 'desc')->paginate(10));

        return response()->json(['data' => $news, 'status' => 'true']);
    }
}
