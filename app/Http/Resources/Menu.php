<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MenuSectionCollection as MenuSectionCollection;

class Menu extends JsonResource
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
            'establishment_id' => $this->establishment_id,
            'establishment_name' => $this->establishment->name,
            'name' => $this->name,
            'menu_sections' => new MenuSectionCollection($this->menuSections),
            'updated_at' => $this->updated_at,
            'qr_code_url' => $this->qrCodeURL(),
        ];
    }
}
