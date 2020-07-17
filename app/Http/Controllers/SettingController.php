<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $data = [];
        $settings = Setting::first();
        array_push($data, [
                'app_web' => @$settings->web_page,
                'fb_page' => @$settings->facebook,
                'fb_group' => @$settings->fb_group,
                'youtube' => @$settings->youtube_channel,
                'twitter' => @$settings->twitter,
                'insta' => @$settings->instagram,
                'whats_up' => @$settings->whats_up,
                'gmail' => @$settings->gmail,
        ]);

        return response()->json(['data' => $data, 'status' => 'true']);
    }

    public function allSettings()
    {
        $settings = Setting::first();

        return response()->json(['data' => $settings, 'status' => 'true']);
    }

    public function settings(Request $request)
    {
        $request->validate([
            'gmail' => 'required|string',
            'facebook' => 'required|string',
            'whats_up' => 'required|string',
            'web_page' => 'required|string',
            'fb_group' => 'required|string',
            'youtube_channel' => 'required|string',
            'twitter' => 'required|string',
            'instagram' => 'required|string',
        ]);
        $setting = Setting::first();
        $setting->gmail = $request->gmail;
        $setting->facebook = $request->facebook;
        $setting->whats_up = $request->whats_up;
        $setting->web_page = $request->web_page;
        $setting->fb_group = $request->fb_group;
        $setting->youtube_channel = $request->youtube_channel;
        $setting->twitter = $request->twitter;
        $setting->instagram = $request->instagram;
        $setting->save();

        return response()->json(['message' => 'Settings Reset Successfully', 'status' => 'true']);
    }
}
