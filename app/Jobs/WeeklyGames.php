<?php

namespace App\Jobs;

use App\Match;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use App\Events\FootballLiveUpdate;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Carbon\Carbon;

class WeeklyGames implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public function __construct()
    {
        $app_key=env('FOOTBALL_APP_KEY');
        $from=Carbon::today()->addDay()->toDateString();
        $to=Carbon::today()->addDays(5)->toDateString();

        $client=new Client();
        $response=$client->request('GET','apiv2.apifootball.com',[
           'query'=>['APIkey'=>$app_key,'action'=>'get_events',
           'from'=>$from,'to'=>$to],
           'verify'=>false
        ]);
        $matches = json_decode($response->getBody());
        if(is_array($matches)){
            $matches=collect($matches);
            $matches_data=[];
            Match::whereBetween('match_date',[$from,$to])->delete();
            foreach($matches as $key=> $match){   
                if(!Match::where('match_id',$match->match_id)->first()){
                    $matches_data[$key]['match_id']=$match->match_id;
                    $matches_data[$key]['league_id']=$match->league_id;
                    $matches_data[$key]['league_name']=$match->league_name;
                    $matches_data[$key]['country_id']=$match->country_id?$match->country_id:null;
                    $matches_data[$key]['country_name']=$match->country_name?$match->country_name:null;
                    $matches_data[$key]['match_hometeam_name']=$match->match_hometeam_name;
                    $matches_data[$key]['match_hometeam_id']=$match->match_hometeam_id?$match->match_hometeam_id:0;
                    $matches_data[$key]['match_hometeam_score']=$match->match_hometeam_score;
                    $matches_data[$key]['match_awayteam_id']=$match->match_awayteam_id?$match->match_awayteam_id:0;
                    $matches_data[$key]['match_awayteam_name']=$match->match_awayteam_name;
                    $matches_data[$key]['match_awayteam_score']=$match->match_awayteam_score;
                    $matches_data[$key]['match_hometeam_penalty_score']=$match->match_hometeam_penalty_score?$match->match_hometeam_penalty_score:null;
                    $matches_data[$key]['match_awayteam_penalty_score']=$match->match_awayteam_penalty_score?$match->match_awayteam_penalty_score:null;
                    $matches_data[$key]['match_time']=Carbon::parse($match->match_time)->addHour()->format('H:i');
                    $matches_data[$key]['match_status']=$match->match_status;
                    $matches_data[$key]['match_live']=$match->match_live;
                    $matches_data[$key]['match_date']=$match->match_date;
                    $matches_data[$key]['goal_scorer']=json_encode($match->goalscorer);
                    $matches_data[$key]['cards']=json_encode($match->cards);
                    $matches_data[$key]['home_substitutions']=json_encode($match->substitutions->home);
                    $matches_data[$key]['away_substitutions']=json_encode($match->substitutions->away);
                    $matches_data[$key]['statistics']=json_encode($match->statistics);
                    $matches_data[$key]['away_lineup']=json_encode($match->lineup->away->starting_lineups);
                    $matches_data[$key]['home_lineup']=json_encode($match->lineup->home->starting_lineups);
                }
            }
            $matches_data=collect($matches_data);
            foreach($matches_data->chunk(50) as $chunk){
                Match::insert($chunk->toArray());
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
    }
}