<?php

namespace App\Http\Controllers;

use App\Advertisment;
use App\Version;
use Illuminate\Http\Request;

class AdvertisementsController extends Controller
{
    public function ads($app)
    {
        $ads = Advertisment::firstOrCreate([
            'branch_id' => $app,
        ]);

        return response()->json($ads, 200);
    }


    public function appAds()
    {
        $ads = Advertisment::where('branch_id', '1')->first();
        $data = [];
        $red = Version::where('branch_id', '1')->orderby('id', 'desc')->first();
        array_push($data, [
                'MobID' => @$ads->bannerI,
                'BannerID' => @$ads->bannerII,
                'BannerFooterID' => @$ads->footer,
                'FullScreenID' => @$ads->full_screen,
                'RewardID' => @$ads->reward,
                'Version' => @$red->name,
        ]);

        return response()->json($data, 200);
    }


    public function saveAds(Request $request, Advertisment $ads)
    {
        $request->validate([
            'bannerI' => 'required|string',
            'bannerII' => 'required|string',
            'footer' => 'required|string',
            'reward' => 'required|string',
            'full_screen' => 'required|string',
            'app' => 'integer',
        ]);
        $ads->update([
            'bannerI' => $request->bannerI,
            'bannerII' => $request->bannerII,
            'footer' => $request->footer,
            'reward' => $request->reward,
            'full_screen' => $request->full_screen,
            'branch_id' => $request->app,
        ]);
    }
}
