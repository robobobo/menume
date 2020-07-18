<?php

namespace App\Http\Controllers;

use App\Establishment;
use Illuminate\Http\Request;

class EstablishmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Launches the onboarding flow for creating a new establishment
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('establishment.onboard');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Establishment  $establishment
     * @return \Illuminate\Http\Response
     */
    public function show(Establishment $establishment)
    {
        return view('establishment.show')->with('establishment',$establishment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Establishment  $establishment
     * @return \Illuminate\Http\Response
     */
    public function edit(Establishment $establishment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Establishment  $establishment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Establishment $establishment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Establishment  $establishment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Establishment $establishment)
    {
        //
    }
}
