<?php

namespace App\Http\Controllers;

use App\Models\salutation;
use App\Http\Requests\StoresalutationRequest;
use App\Http\Requests\UpdatesalutationRequest;

class SalutationController extends Controller
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
     * @param  \App\Http\Requests\StoresalutationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoresalutationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\salutation  $salutation
     * @return \Illuminate\Http\Response
     */
    public function show(salutation $salutation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\salutation  $salutation
     * @return \Illuminate\Http\Response
     */
    public function edit(salutation $salutation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatesalutationRequest  $request
     * @param  \App\Models\salutation  $salutation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatesalutationRequest $request, salutation $salutation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\salutation  $salutation
     * @return \Illuminate\Http\Response
     */
    public function destroy(salutation $salutation)
    {
        //
    }
}
