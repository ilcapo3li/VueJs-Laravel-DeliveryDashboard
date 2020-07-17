<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Source extends JsonResource
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
            'id'=>$this->id,
            'source'=>$this->source,
            'link'=>$this->link,
            'info'=>$this->info,
            'photo'=>$this->photo ? $this->photo->path : "/default/default.png",
            'photo_id'=>$this->photo?$this->photo->id:null
          
          ];
    }
}
