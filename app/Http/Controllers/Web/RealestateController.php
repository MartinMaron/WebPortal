<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\UpdateRealestateRequest;
use App\Models\Realestate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Termwind\Components\Dd;

class RealestateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('backend.realestate.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }


    /**
     * @param Realestate $realestate
     * @return void
     */
    public function store(Realestate $realestate)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Realestate $realestate
     * @return Response
     */
    public function show(Realestate $realestate)
    {
        return view('backend.realestate.dashboard', compact('realestate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Realestate $realestate
     * @return void
     */
    public function edit(Realestate $realestate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Realestate $realestate
     * @return void
     */
    public function update(Request $request, Realestate $realestate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Realestate $realestate
     * @return void
     */
    public function destroy(Realestate $realestate)
    {
        //
    }
}
