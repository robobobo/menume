<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\Establishment as EstablishmentResource;
use App\Establishment;

class EstablishmentController extends Controller
{
    //
    /*TODO set this up someday https://laravel.com/docs/master/validation#creating-form-requests */
    public function create(Request $request)
    {
        $validatedData = $request->validate([
              'name' => 'required|string',
              'contact_person'=>'required|string',
              'email_address'=>'required|email',
              'contact_number'=>'required',
              'address_1' => 'nullable|string',
              'address_2' => 'nullable|string',
              'town_city'=>'nullable|string',
              'postcode'=>'nullable|string',
              'county'=>'nullable|string',
              'country'=>'nullable|string',
              'currency'=>'required|string',
          ]);
          
        /*its passed validation if it got here*/
        $establishment = Establishment::create($request->input());
        return new EstablishmentResource($establishment);
    }

    public function update(Establishment $establishment, Request $request)
    {
        // sometimes means its only required if the field is present on the request
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string',
            'contact_person'=>'sometimes|required|string',
            'email_address'=>'sometimes|required|email',
            'contact_number'=>'sometimes|required',
            'address_1' => 'nullable|string',
            'address_2' => 'nullable|string',
            'town_city'=>'nullable|string',
            'postcode'=>'nullable|string',
            'county'=>'nullable|string',
            'country'=>'nullable|string',
            'currency'=>'sometimes|required|string',
        ]);
        
        /*its passed validation if it got here*/
        if ($establishment->update($request->input())) {
            return response()->json(['message'=>'ok'], 200);
        } else {
            return response()->json(['message'=>'Unable to update'], 500);
        }
    }
}
