<?php

use Illuminate\Database\Seeder;
use App\City;


class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('city')->delete();
        // $json = File::get('database/data/cities.json');
        // foreach (json_decode($json) as $row) {
        //     City::Create([
        //     'en_name' => $row->en_name,
        //     'ar_name' => $row->ar_name,
        //     'lat' => $row->ar_name,
        //     'lng' => $row->ar_name,
        //    ]);
        // }

        City::Create([
            'en_name' => $row->en_name,
            'ar_name' => $row->ar_name,
           
           ]);
       
    }
}
