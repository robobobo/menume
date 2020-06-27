<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuItem extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'menu_section_id' => $this->menu_section_id,
            'position' => $this->position,
            'price' => $this->price,
            'updated_at' => $this->updated_at,
            'type' => 'menu_item',
        ];
    }
}
