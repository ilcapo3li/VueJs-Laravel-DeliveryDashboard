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
       

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'photo' => $this->photo ? url($this->photo->path) : '/default/default.jpg',
            'is_blocked' => $this->blocked,
            ///////////////////User Data//////////////////////
            'orders' => $this->orders,
            'locations' => $this->locations,
            'reports' => $this->reports,
            'myLeads' => $this->leads,
            ///////////////User Role & Permissions///////////////
            'role' => @$this->role->name,
            'permissions' => $this->permissions,
        ];
    }
}
