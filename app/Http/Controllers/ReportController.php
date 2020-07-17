<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the rereport.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = Report::with(['user','user.photo'])->orderBy('id', 'desc')->paginate(10);
        return response()->json(['data'=> $reports,'status' => 'true']);
    }

    /**
     * Show the form for creating a new rereport.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created rereport in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         
    }

    public function report(Request $request)
    {
        $validator= Validator::make($request->all(), [
            'name'=>'required',
            'type'=>'required',
            'message'=>'required',
            
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        } else {
            if ($request->logo) {
                $photo= new PhotoHelper();
                $photo_id=$photo->constructPhoto($request->logo, 'report');
            }
            $report = new Report();
            $report->name = $request->name ;
            $report->user_id = Auth::id();
            $report->type = $request->type;
            $report->message = $request->message;
            $report->status = "open";
            $request->logo ?
            $report->photo_id = $photo_id : $report->photo_id = null;
            $report->save();
            return response()->json(['status' => 'true']);
        }
    }

    /**
     * Display the specified rereport.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified rereport.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified rereport in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified rereport from storage.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
}