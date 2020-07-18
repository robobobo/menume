<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Establishment extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'updated_at' => $this->updated_at,
            'qr_code_url' => $this->qrCodeURL(),
            'currency' => $this->currency,
            'contact_person' => $this->contact_person,
            'email_address' => $this->email_address,
            'contact_number' => $this->contact_number,
            'address_1' => $this->address_1,
            'address_2' => $this->address_2,
            'town_city' => $this->town_city,
            'postcode' => $this->postcode,
            'county' => $this->county,
            'country' => $this->country,
        ];
    }
}
