<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Source;
use App\Http\Resources\SourceCollection;

class SourceController extends Controller
{
    public function saveSource(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'source' => 'required|unique:sources,source',
            'link' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        } else {
            $source = new Source();
            $source->source = $request->source;
            $source->link = $request->link;
            $source->info = $request->info;
            $source->photo_id = $request->logo;
            $source->save();

            return response()->json(['message' => 'Source Saved Successfully', 'status' => 'true']);
        }
    }

    public function updateSource(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'source' => 'required|unique:sources,source,'.$id,
            'link' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        } else {
            $source = Source::findorfail($id);
            $source->source = $request->source;
            $source->link = $request->link;
            $source->info = $request->info;
            $source->photo_id = $request->logo;
            $source->save();

            return response()->json(['message' => 'Source updated Successfully', 'status' => 'true']);
        }
    }

    public function deleteSource(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'source_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        } else {
            $source = Source::findorfail($request->source_id);
            $source->delete();

            return response()->json(['message' => 'Source Deleted Successfully', 'status' => 'true']);
        }
    }

    public function getSource()
    {
        return new SourceCollection(Source::orderBy('id', 'desc')->paginate(10));
    }

    public function allSource()
    {
        return new SourceCollection(Source::orderBy('id', 'desc')->get());
    }

    public function newsSource(Request $request)
    {
        $news = new NewsPostsCollection(NewsPost::where('id', $request->news_id)->paginate(10));

        return response()->json(['data' => $news, 'status' => 'true']);
    }
}
