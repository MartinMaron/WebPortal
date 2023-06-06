<?php

namespace App\Http\Controllers\Web;

use App\Models\counterMeter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorecounterMeterRequest;
use App\Http\Requests\UpdatecounterMeterRequest;

class CounterMeterController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorecounterMeterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorecounterMeterRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\counterMeter  $counterMeter
     * @return \Illuminate\Http\Response
     */
    public function show(counterMeter $counterMeter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\counterMeter  $counterMeter
     * @return \Illuminate\Http\Response
     */
    public function edit(counterMeter $counterMeter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecounterMeterRequest  $request
     * @param  \App\Models\counterMeter  $counterMeter
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecounterMeterRequest $request, counterMeter $counterMeter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\counterMeter  $counterMeter
     * @return \Illuminate\Http\Response
     */
    public function destroy(counterMeter $counterMeter)
    {
        //
    }
}
