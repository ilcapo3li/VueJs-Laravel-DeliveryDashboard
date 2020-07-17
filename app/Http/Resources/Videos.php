<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Videos extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $comment_details =[] ;
      
        foreach($this->comments as $comment)
        {
           array_push($comment_details ,[
            'user_id'=>$comment->user_id,
            'user_name'=>$comment->user->name,
            'user_photo'=>@$comment->user->photo? $comment->user->photo->path : "/default/teams.png",
            'comment_id'=>$comment->id,
            'comment'=>$comment->comment,
            'comment_like'=>@$comment->likedComment,
            'comment_like_number'=>@Count($comment->likedComment),
            'comment_date'=>$this->created_at
          ]);
          
        }

        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'body'=>$this->body,
            'link'=>$this->link,
            'photo'=>@$this->photo ? $this->photo->path :"/default/default.png" ,
            'photo_id'=>$this->photo_id,
            'server_id'=>$this->server_id,
            'creator'=>$this->creator_id,
            'ranks'=>$this->ranks,
            'status'=>$this->status,
            'trend'=>$this->trend,
            'source'=>$this->source_id,
            'touranment_type'=>$this->toranment_type_id,
            'server'=>@$this->server->ar_name ? $this->server->ar_name : @$this->server->en_name,
            'comments_number'=>@count($this->comments),
            'user_comments'=>$comment_details,
            'likes'=>@$this->likedVideo,
            'likes_number'=>@count($this->likedVideo),
            'sport_name'=>@$this->sport->ar_name?$this->sport->ar_name : @$this->sport->en_name,
            'sport_type'=>@$this->sport->type,
            'source_name'=>@$this->source->source,
            'source_link'=>@$this->source->link,
            'source_type'=>@$this->source->info,
            'source_logo'=>@$this->source->photo ? $this->source->photo->path :"/default/teams.png",
            'video_link'=>url('/iframe/'.$this->id),
            ];
    }
}
