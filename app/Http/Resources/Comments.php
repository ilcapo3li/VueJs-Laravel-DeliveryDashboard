<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Comments extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user_id'=>$this->user_id,
            'user_name'=>$this->user->name,
            'user_photo'=>$this->user->photo ? $this->user->photo->path :url("/default/teams.png"), 
            'comment_id'=>$this->id,
            'comment'=>$this->comment,
            'comment_like'=>@$this->likedComment,
            'comment_like_number'=>@Count($this->likedComment),
            'comment_date'=>$this->created_at,

        ];
    }
}
