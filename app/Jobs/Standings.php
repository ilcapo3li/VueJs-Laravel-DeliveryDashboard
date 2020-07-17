<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\League;
use App\Standing;
use GuzzleHttp\Client;

class Standings implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $app_key=env('FOOTBALL_APP_KEY');
        $client=new Client();
        $standings_data=[];
        $leagues=League::where('rank','>',0)->get();
        foreach($leagues as $league){
                $response=$client->request('GET','apiv2.apifootball.com',[
                    'query'=>['APIkey'=>$app_key,
                    'action'=>'get_standings',
                    'league_id'=>$league->id],
                    'verify'=>false
                 ]);
                 $standings=json_decode($response->getBody());
               
                if(is_array($standings)){
                Standing::where('league_id',$league->id)->delete();
                    $standings=collect($standings);
                    foreach($standings as $key=> $standing){
                        $standings_data[$key]['country_name']=$standing->country_name?$standing->country_name:null;
                        $standings_data[$key]['league_id']=$standing->league_id?$standing->league_id:null;
                        $standings_data[$key]['league_name']=$standing->league_name?$standing->league_name:null;
                        $standings_data[$key]['team_id']=$standing->team_id?$standing->team_id:null;
                        $standings_data[$key]['team_name']=$standing->team_name?$standing->team_name:null;
                        $standings_data[$key]['overall_league_position']=$standing->overall_league_position?$standing->overall_league_position:null;
                        $standings_data[$key]['overall_league_payed']=$standing->overall_league_payed?$standing->overall_league_payed:null;
                        $standings_data[$key]['overall_league_W']=$standing->overall_league_W?$standing->overall_league_W:null;
                        $standings_data[$key]['overall_league_D']=$standing->overall_league_D?$standing->overall_league_D:null;
                        $standings_data[$key]['overall_league_L']=$standing->overall_league_L?$standing->overall_league_L:null;
                        $standings_data[$key]['overall_league_GF']=$standing->overall_league_GF?$standing->overall_league_GF:null;
                        $standings_data[$key]['overall_league_GA']=$standing->overall_league_GA?$standing->overall_league_GA:null;
                        $standings_data[$key]['overall_league_PTS']=$standing->overall_league_PTS?$standing->overall_league_PTS:null;
                        $standings_data[$key]['home_league_position']=$standing->home_league_position?$standing->home_league_position:null;
                        $standings_data[$key]['home_league_payed']=$standing->home_league_payed?$standing->home_league_payed:null;
                        $standings_data[$key]['home_league_W']=$standing->home_league_W?$standing->home_league_W:null;
                        $standings_data[$key]['home_league_D']=$standing->home_league_D?$standing->home_league_D:null;
                        $standings_data[$key]['home_league_L']=$standing->home_league_L?$standing->home_league_L:null;
                        $standings_data[$key]['home_league_GF']=$standing->home_league_GF?$standing->home_league_GF:null;
                        $standings_data[$key]['home_league_GA']=$standing->home_league_GA?$standing->home_league_GA:null;
                        $standings_data[$key]['home_league_PTS']=$standing->home_league_PTS?$standing->home_league_PTS:null;
                        $standings_data[$key]['home_league_GA']=$standing->home_league_GA?$standing->home_league_GA:null;
                        $standings_data[$key]['away_league_position']=$standing->away_league_position?$standing->away_league_position:null;
                        $standings_data[$key]['away_league_payed']=$standing->away_league_payed?$standing->away_league_payed:null;
                        $standings_data[$key]['away_league_W']=$standing->away_league_W?$standing->away_league_W:null;
                        $standings_data[$key]['away_league_D']=$standing->away_league_D?$standing->away_league_D:null;
                        $standings_data[$key]['away_league_L']=$standing->away_league_L?$standing->away_league_L:null;
                        $standings_data[$key]['away_league_GF']=$standing->away_league_GF?$standing->away_league_GF:null;
                        $standings_data[$key]['away_league_GA']=$standing->away_league_GA?$standing->away_league_GA:null;
                        $standings_data[$key]['away_league_PTS']=$standing->away_league_PTS?$standing->away_league_PTS:null;  
                        $standings_data[$key]['league_round']=$standing->league_round?$standing->league_round:null;  
                    }
                    Standing::insert($standings_data);
                    $standings_data=[];
                }
                        
                        
        }  
        
  
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    }
}
