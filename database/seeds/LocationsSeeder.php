<?php

use Illuminate\Database\Seeder;
use App\Location;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Location::create([
            'owner_id' => '1',
            'owner_type' => 'Lead',
            'country_id' => 64,
            'city_id' => 1,


            'address' => '25 kom-eldeka Alexandria Foad street',
            'location' => '{
                                "country_code": "EG",
                                "country_name": "Egypt",
                                "city": "Alexandria",
                                "postal": 21426,
                                "latitude": 24.6537,
                                "longitude": 46.7152,
                                "IPv4": "51.39.2.231",
                                "state": "Alexandria"
                                }',
        ]);
        Location::create([
            'owner_id' => '2',
            'owner_type' => 'Lead',
            'country_id' => 64,
            'city_id' => 1,


            'address' => '25 kom-eldeka Alexandria Foad street',
            'location' => '{
                                "country_code": "EG",
                                "country_name": "Egypt",
                                "city": "Alexandria",
                                "postal": 21426,
                                "latitude": 24.6537,
                                "longitude": 46.7152,
                                "IPv4": "51.39.2.231",
                                "state": "Alexandria"
                                }',
        ]);
        Location::create([
            'owner_id' => '1',
            'owner_type' => 'Agent',
            'country_id' => 64,
            'city_id' => 1,



            'address' => '25 kom-eldeka Alexandria Foad street',
            'location' => '{
                                "country_code": "EG",
                                "country_name": "Egypt",
                                "city": "Alexandria",
                                "postal": 21426,
                                "latitude": 24.6537,
                                "longitude": 46.7152,
                                "IPv4": "51.39.2.231",
                                "state": "Alexandria"
                                }',
        ]);

        Location::create([
            'owner_id' => '1',
            'owner_type' => 'Lead',
            'country_id' => 64,
            'city_id' => 1,



            'address' => 'Kom Eldekkkka',
            'location' => '{
                                "country_code": "EG",
                                "country_name": "Egypt",
                                "city": "Alexandria",
                                "postal": 21426,
                                "latitude": 24.6537,
                                "longitude": 46.7152,
                                "IPv4": "51.39.2.231",
                                "state": "Alexandria"
                                }',
        ]);
        Location::create([
            'owner_id' => '1',
            'owner_type' => 'Lead',
            'country_id' => 64,
            'city_id' => 1,


            'address' => 'Mhatet el Rameel ',
            'location' => '{
                                "country_code": "EG",
                                "country_name": "Egypt",
                                "city": "Alexandria",
                                "postal": 21426,
                                "latitude": 24.6537,
                                "longitude": 46.7152,
                                "IPv4": "51.39.2.231",
                                "state": "Alexandria"
                                }',
        ]);
    }
}
