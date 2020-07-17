<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Category;
use App\League;
use App\Match;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        // if($this->leagues && $this->matches&& $this->categories){
        // $favouriteLeagues = new LeaguesCollection(@League::whereIn('id',@$this->leagues->pluck('type_id'))->get());
        // $favouriteMatches = new LeaguesCollection(@Match::whereIn('id',@$this->matches->pluck('type_id'))->get());
        // $favouriteCategories = new LeaguesCollection(@Category::whereIn('id',@$this->categories->pluck('type_id'))->get());
        // }

        return [
            'data' => [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'photo' => $this->photo ? url($this->photo->path) : '/default/teams.png',
            'is_blocked' => $this->blocked,
            //////////////////////User Favourities/////////////////
            'favourite_leagues' => $this->favouriteLeagues,
            'favourite_matches' => $this->favouriteMatches,
            'favourite_news' => $this->favouriteNews,
            'favourite_videos' => $this->favouriteVideos,
            'favourite_standings' => $this->favouriteStandings,
            'favourite_catigories' => $this->favouriteCategories,
            'favourite_TournamentMatch' => $this->favouriteTournamentMatch,
            'favourite_channels' => $this->favouriteChannels,
            /////////////////User Likes////////////////////////////
            'liked_video' => $this->likedVideo,
            'liked_news' => $this->likedNews,
            'liked_comments' => $this->likedComment,
            'liked_channels' => $this->likedChannel,
            ///////////////////User Comments//////////////////////
            'video_comments' => $this->videosComments,
            'news_comments' => $this->newsComments,
            'reply_comments' => $this->replayComments,
            'channel_comments' => $this->channelComments,
            'channel_comments' => $this->matchComments,
            ///////////////User Role & Permissions///////////////
            'role' => @$this->role->name,
            'permissions' => $this->permissions,
            ],
            'status' => 'true',
        ];
    }
}
