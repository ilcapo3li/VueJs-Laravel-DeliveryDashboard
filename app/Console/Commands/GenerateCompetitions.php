<?php

namespace App\Console\Commands;

use App\League;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class GenerateCompetitions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'leagues:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get supported competitions from api';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $app_key=env('FOOTBALL_APP_KEY');
        $client=new Client();
        $response=$client->request('GET', 'apiv2.apifootball.com', [
           'query'=>['APIkey'=>$app_key,'action'=>'get_leagues'],
           'verify'=>false
        ]);
        $leagues=json_decode($response->getBody());
        $leagues=collect($leagues);
        $leagues_chunks=$leagues->chunk(100);
        $leagues_chunks->each(function ($chunk) {
            $chunk->each(function ($item) {
                $new_league=new League();
                $new_league->league_name=$item->league_name;
                $new_league->id=$item->league_id;
                $new_league->country_id=$item->country_id;
                $new_league->country_name=$item->country_name;
                $new_league->save();
            });
        });
    }
}
