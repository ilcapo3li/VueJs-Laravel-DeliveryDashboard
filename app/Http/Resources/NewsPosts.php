<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsPosts extends JsonResource
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
            'user_photo'=>$comment->user&&$comment->user->photo?$comment->user->photo->path : "/default/teams.png",
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
          'rank'=>$this->rank,
          'trend'=>$this->trend,
          'photo'=>$this->postPhoto ? $this->postPhoto->path : "/default/default.png",
          'photo_id'=>$this->photo_id,
          'comments_number'=>@count($this->comments),
          'user_comments'=>$comment_details,
          'sport_id'=>$this->toranment_type_id,
          'source_id'=>$this->source_id,
          'likes'=>@$this->likedNews,
          'likes_number'=>@count($this->likedNews),
          'sport_name'=>@$this->sport->ar_name?$this->sport->ar_name : @$this->sport->en_name,
          'sport_type'=>@$this->sport->type,

          'source_name'=>@$this->source->source,
            'source_link'=>@$this->source->link,
            'source_type'=>@$this->source->info,
            'source_logo'=>@$this->source->photo->path ? $this->source->photo->path :"/default/teams.png",


        
        ];
    }
}
