<?php

namespace App\Http\Controllers\Web;

use App\Models\Realestate;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRealestateRequest;
use App\Http\Requests\UpdateRealestateRequest;

class RealestateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.realestate.index');
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
     * @param  \App\Http\Requests\StoreRealestateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRealestateRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Realestate  $realestate
     * @return \Illuminate\Http\Response
     */
    public function show(Realestate $realestate)
    {
        return view('backend.realestate.show-occupants', compact('realestate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Realestate  $realestate
     * @return \Illuminate\Http\Response
     */
    public function edit(Realestate $realestate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRealestateRequest  $request
     * @param  \App\Models\Realestate  $realestate
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRealestateRequest $request, Realestate $realestate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Realestate  $realestate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Realestate $realestate)
    {
        //
    }
}
