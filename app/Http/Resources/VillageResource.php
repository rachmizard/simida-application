<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class VillageResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id_village' => $this->id,
            'district_id' => $this->district_id,
            'village_name' => $this->name
        ];
    }
}
