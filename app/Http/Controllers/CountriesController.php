<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CountriesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->query) {
            $countries=Country::where('country_name', 'like', Input::get('query').'%')->paginate(10);
        } else {
            $countries=Country::paginate(10);
        }
        return response()->json($countries);
    }

    public function countries()
    {
        $countries=Country::all();
        return response()->json(['countries'=>$countries]);
    }

    public function getLeagues($country_id)
    {
        $leagues=Country::find($country_id)->leagues->load('photo');
        return response()->json(['leagues'=>$leagues]);
    }
}
