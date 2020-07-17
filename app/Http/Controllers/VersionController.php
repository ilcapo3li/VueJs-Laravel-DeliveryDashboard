<?php

namespace App\Http\Controllers;

use App\Version;
use App\Branch;
use Illuminate\Http\Request;
use Storage;

class VersionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Branch $app)
    {
        $request->validate([
            'app' => 'required|integer',
            'name' => 'required|string|unique:versions,name',
            'description' => 'required|string',
            'apk' => 'required|file|max:30720',
        ]);
        if ($request->apk->getClientOriginalExtension() != 'apk') {
            return response()->json(['errors' => ['message'=>'File Must Be APK']], 422);
        }
        $file = $request->apk;
        $branch = preg_replace('/\s+/', '', $app->application_name);
        $extension = $file->getClientOriginalExtension(); // getting file extension
        $filename = $request->name.'.'.$extension;
        $path='public'.DIRECTORY_SEPARATOR.$branch.DIRECTORY_SEPARATOR.$filename;
        $file->storeAs('public'.DIRECTORY_SEPARATOR.$branch, $filename);
        $apk = new Version();
        $apk->name = $request->name;
        $apk->description = $request->description;
        $apk->branch_id = $request->app;
        $apk->path =$path;
        $apk->save();

        return response()->json(['message' => 'APK is Uploaded Success'], 200);
    }

    /**
     * Display the latest resource.
     *
     * @param
     *
     * @return \Illuminate\Http\Response
     * *paths
     */
    public function getLatest()
    {
        $red = Version::where('branch_id', '1')->orderby('id', 'desc')->first();
        $gold = Version::where('branch_id', '2')->orderby('id', 'desc')->first();
        $store = Version::where('branch_id', '3')->orderby('id', 'desc')->first();
        $path = collect([
            'red' => $red ? Storage::url($red->path) :"" ,
            'redDate' => $red ? date('h:m:s d-m-Y ',Storage::lastModified($red->path)) :"" ,
            'gold' => $gold ? Storage::url($gold->path) :"" ,
            'goldDate' => $gold ? date('h:m:s d-m-Y ',Storage::lastModified($gold->path)) :"" ,
            'store' => $store ? Storage::url($store->path) :"" ,
            'storeDate' => $store ? date('h:m:s d-m-Y ',Storage::lastModified($store->path)) :"" 
            ]);

        return response()->json(['data' => $path], 200);
    }

    public function DownRed()
    {
        $red = Version::where('branch_id', '1')->orderby('id', 'desc')->first();
        if($red){
        return Storage::download($red->path);
        }
    }

    public function DownGold()
    {
        $gold = Version::where('branch_id', '2')->orderby('id', 'desc')->first();
        if($gold){
        return Storage::download($gold->path);
        }
    }

    public function DownStore()
    {
        $store = Version::where('branch_id', '3')->orderby('id', 'desc')->first();
        if($store){
        return Storage::download($store->path);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Version $version
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Version $version)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Version $version
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Version $version)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Version             $version
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Version $version)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Version $version
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Version $version)
    {
        File::delete(storage_path().DIRECTORY_SEPARATOR.$version->path);
        $version->delete();
        return response()->json(['message' => 'Apk Deleted Successfully', 'status' => 'true']);
    }
}
