<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use App\Http\Resources\VideosCollection;
use Illuminate\Support\Facades\Validator;
use App\Helpers\PhotoHelper;

class VideosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new VideosCollection(Video::orderBy('id', 'desc')->paginate(10));
    }

    public function saveVideo(Request $request)
    {
        $validator=Validator::make($request->all(), [
            'title'=>'required',
            'body'=>'required',
            'link'=>'required',
            'sport'=>'required',
            'server_id'=>'required',
            'source'=>'required',
           
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        } else {
            $video = new Video();
            $video->title = $request->title;
            $video->body = $request->body;
            $video->link= $request->link;
            $video->ranks = 1;
            $video->trend = $request->trend;
            $video->status = $request->status;
            $video->source_id = $request->source;
            $video->server_id = $request->server_id;
            $video->creator_id = @Auth()->user()->id ? Auth()->user()->id : 1;
            $video->toranment_type_id = $request->sport;
            $video->photo_id = $request->logo;
            $video->save();
            return response()->json(['message'=>'Video Saved Successfully','status'=>'true']);

        }
    }
    public function updateVideo(Request $request, $id)
    {
        $validator=Validator::make($request->all(), [
            'title'=>'required',
            'body'=>'required',
            'link'=>'required',
            'sport'=>'required',
            'server_id'=>'required',
            'source'=>'required',
                 
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        } else {
            $video = Video::find($id);
            $video->title = $request->title;
            $video->body = $request->body;
            $video->link= $request->link;
            $video->ranks = 1;
            $video->trend = $request->trend;
            $video->status = $request->status;
            $video->source_id = $request->source;
            $video->server_id = $request->server_id;
            $video->creator_id = @Auth()->user()->id ? Auth()->user()->id :1;
            $video->toranment_type_id = $request->sport;
            $video->photo_id =  $request->logo;
            $video->save();
            return response()->json(['message'=>'Video Updated Successfully','status'=>'true']);

        }
    }
    public function deleteVideo(Request $request)
    {
        $validator=Validator::make($request->all(), [
            'video_id'=>'required',
            
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        } else {
            $video = Video::find($request->video_id);
            $video->delete();
            return response()->json(['message'=>'Video Deleted Successfully','status'=>'true']);

        }
    }


    public function getVideos()
    {
        $videos = new VideosCollection(Video::orderby('id', 'desc')->paginate(10));
        $trended_videos=new VideosCollection(Video::where('trend', 'trend')->orderby('id', 'desc')->paginate(10));
        return response()->json(['data'=>['videos'=>$videos,'trended_videos'=>$trended_videos],'status'=>'true']);
    }

    public function videoDetails(Request $request)
    {
        $videos = new VideosCollection(Video::where('id', $request->video_id)->paginate(10));

        return response()->json(['data'=>$videos,'status'=>'true']);
    }

    public function videos()
    {
        $videos = new VideosCollection(Video::orderby('id', 'desc')->paginate(10));
        $trend_videos = new VideosCollection(Video::where('trend', 'trend')->orderby('id', 'desc')->paginate(10));

        return response()->json(['data'=>[$videos,$trend_videos],'status'=>'true']);
    }


}
