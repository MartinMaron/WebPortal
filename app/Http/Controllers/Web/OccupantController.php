<?php

namespace App\Http\Controllers\Web;

use App\Models\occupant;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreoccupantRequest;
use App\Http\Requests\UpdateoccupantRequest;

class OccupantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.occupant.index');
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
     * @param  \App\Http\Requests\StoreoccupantRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreoccupantRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\occupant  $occupant
     * @return \Illuminate\Http\Response
     */
    public function show(occupant $occupant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\occupant  $occupant
     * @return \Illuminate\Http\Response
     */
    public function edit(occupant $occupant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateoccupantRequest  $request
     * @param  \App\Models\occupant  $occupant
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateoccupantRequest $request, occupant $occupant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\occupant  $occupant
     * @return \Illuminate\Http\Response
     */
    public function destroy(occupant $occupant)
    {
        //
    }
}
