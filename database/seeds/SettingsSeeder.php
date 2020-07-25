<?php

use Illuminate\Database\Seeder;
use App\ApiKey;
use App\Branch;
use App\Currency;
use App\DeliverySetting;
use App\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        ApiKey::create([
            'token' => 'italy',
        ]);

        Branch::create([
            'application_name' => 'Region1',
            'firebase_token' => '',
        ]);

        Branch::create([
            'application_name' => 'Region2',
            'firebase_token' => '',
        ]);

        Currency::create([
            'ar_name' => 'Egyptian Pound',
            'en_name' => 'Egyptian Pound',
            'code' => 'EGP',
            'rate' => '0.09',
        ]);

        Currency::create([
            'ar_name' => 'Saudi Ryal',
            'en_name' => 'Saudi Ryal',
            'en_name' => 'SAR',
            'rate' => '0.35',
        ]);

        DeliverySetting::create([
            'orderPrice' => 7.0,
            'kmCost' => 0.3,
            'mQubeCost' => 20.0,
            'kgCost' => 30.0,
            'retriveCost' => 40,
            'currency_id' => 1,
        ]);

        Setting::create([
            'gmail' => '',
            'facebook' => '',
            'whats' => '',
            'website' => '',
            'fbGroup' => '',
            'youtube' => '',
            'twitter' => '',
            'instgram' => '',
        ]);
    }
}
