<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Categories extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return 
        [
            'category_id'=> $this->id,
            'category_name'=> $this->ar_name ? $this->ar_name : $this->en_name,
            'category_en_name'=> $this->en_name ? $this->en_name : $this->ar_name,
            'category_discription'=> $this->discription,
            'category_photo'=> $this->photo?$this->photo->path:"/default/default.png",
            'categories_rank'=> $this->rank,
            'photo_id'=>$this->photo?$this->photo->id:null,
            'status'=> $this->status,
        ];
    }
}
