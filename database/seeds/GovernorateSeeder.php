<?php

use Illuminate\Database\Seeder;
use App\Governorate;

class GovernorateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('governorates')->delete();
        $json = File::get('database/data/governorates.json');
        foreach (json_decode($json) as $row) {
            Governorate::Create([
            'en_name' => $row->en_name,
            'ar_name' => $row->ar_name,
            'lat' => $row->lat,
            'lng' => $row->lng,
            'population'=>$row->population,
            'country_id'=>$row->country_id,
           ]);
        }
    }
}
