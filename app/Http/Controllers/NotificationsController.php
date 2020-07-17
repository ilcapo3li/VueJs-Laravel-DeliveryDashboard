<?php

namespace App\Http\Controllers;

use App\ApiKey;
use App\Notification\Firebase;
use App\Notification\Push;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificationsController extends Controller
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
     * send the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendNotification(Request $request)
    {
        if ($request->notify_type == "update") {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'message' => 'required',
                'notify_type' => 'required',
                'url_update' => 'required',
            ]);
            $version_name = Setting::first()->version_name;
            $push = new Push(
                $request->title,
                $request->message,
                $request->url_update,
                $request->notify_type,
                null,
                null,
                $version_name
            );
        } elseif ($request->notify_type == "Match") {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'notify_type' => 'required',
                'match_id' => 'required',
                'match_type' => 'required',
                'message' => 'required',
            ]);
            $push = new Push(
                $request->title,
                $request->message,
                null,
                $request->notify_type,
                $request->match_id,
                $request->match_type,
                null
            );
        } else {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'message' => 'required',
            ]);
            //if the push don't have any action
            $push = new Push(
                $request->title,
                $request->message,
                null,
                null,
                null,
                null,
                null
            );
        }
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => 'false'], 422);
        } else {
            //getting the push from push object
            $mPushNotification = $push->getPush();
            switch ($request->app) {
                case 1:
                    $devicetoken = $this->userGroup($request->groupType, 1);
                    break;

                case 2:
                    $devicetoken = $this->userGroup($request->groupType, 2);
                    break;

                case 3:
                    $devicetoken = $this->userGroup($request->groupType, 3);
                    break;
            }
            //creating firebase class object
            $firebase = new Firebase();
            //admin_notify_loging
            //sending push notification and displaying result
            return $firebase->send($devicetoken, $mPushNotification, $request->app);
        }
    }

    private function userGroup($groupType, $app)
    {
        switch ($request->app) {
            case "unique":
                //getting the token from database object for spacific users
                $key = ApiKey::where('user_id', $request->reporter)->pluck('token');

                break;

            case "group":
                //getting the token from database object for group of users favourite
                // $users = User::
                // $key = ApiKey::whereIn('user_id', $users)->pluck('token');
                return response()->json(['error' => ['error' => 'Under Constraction Option'], 'status' => 'false'], 422);

                break;

            default:
                //getting the token from database object for all users
                $key = ApiKey::where('branch_id', $app)->pluck('token');

                break;
        }
        return $key;
    }
}
