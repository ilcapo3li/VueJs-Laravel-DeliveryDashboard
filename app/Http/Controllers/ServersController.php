<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Server;
use App\Video;
use App\ServerGenerator;
use App\Http\Resources\ServersCollection;

class ServersController extends Controller
{
    public function getServer()
    {
        return new ServersCollection(Server::orderBy('id', 'desc')->paginate(15));
    }

    public function videoServer()
    {
        return new ServersCollection(Server::where('type', 'video')->orderBy('id', 'desc')->get());
    }

    public function saveServer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ar_name' => 'required|unique:servers,ar_name',
            'en_name' => 'required|unique:servers,en_name',
            'type' => 'required',
            'code' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        } else {
            $server = new Server();
            $server->ar_name = $request->ar_name;
            $server->en_name = $request->en_name;
            $server->status = $request->status;
            $server->type = $request->type;
            $server->code = $request->code;
            $server->save();

            return response()->json(['message' => 'Server Saved Successfully', 'status' => 'true']);
        }
    }

    public function updateServer(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'ar_name' => 'required|unique:servers,ar_name,'.$id,
            'en_name' => 'required|unique:servers,en_name,'.$id,
            'type' => 'required',
            'code' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        } else {
            $server = Server::findorfail($id);
            $server->ar_name = $request->ar_name;
            $server->en_name = $request->en_name;
            $server->status = $request->status;
            $server->type = $request->type;
            $server->code = $request->code;
            $server->save();

            return response()->json(['message' => 'Server Updated Successfully', 'status' => 'true']);
        }
    }

    public function deleteServer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'server_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        } else {
            $server = Server::find($request->server_id);
            if ($server->videos) {
                $server->videos()->delete();
            }
            $server->delete();

            return response()->json(['message' => 'Server Deleted Successfully', 'status' => 'true']);
        }
    }

    public function getServerById(Request $request)
    {
        $server = Server::find($request->id);

        return response()->json($server);
    }

    public function iframesChannels()
    {
        $server = Server::where('type', 'channel')->orderBy('id', 'desc')->get();

        return response()->json($server);
    }

    public function iframeServerChannels(Request $request)
    {
        if ($request->has('id')) {
            $serverGenerator = ServerGenerator::find($request->id);
            $pattern = '/src="\w+"/i';
            $serverGenerator->link = preg_replace($pattern, 'src='.$serverGenerator->link.'', $serverGenerator->server->code);
        } else {
            $serverGenerator = ServerGenerator::where('server_id', '!=', null)
                ->where('link_type', 'secure')
                ->orderBy('id', 'desc')->get();

            $pattern = '/src="\w+"/i';
            foreach ($serverGenerator as $generator) {
                $generator->link = preg_replace($pattern, 'src='.$generator->link.'', $generator->server->code);
            }
        }

        return response()->json($serverGenerator);
    }

    public function getIframeServers(Request $request)
    {
        if ($request->has('id')) {
            $videos = Video::where('id', $request->id)
                ->first();
            $pattern = '/src="\w+"/i';
            $videos->link = preg_replace($pattern, 'src='.$videos->link.'', $videos->server->code);
        } else {
            $videos = Video::where('server_id', '!=', null)
                ->where('trend', 'trend')
                ->orderBy('id', 'desc')->get();
            $pattern = '/src="\w+"/i';
            foreach ($videos as $video) {
                $video->link = preg_replace($pattern, 'src='.$video->link.'', $video->server->code);
            }
        }

        return response()->json($videos);
    }
}
