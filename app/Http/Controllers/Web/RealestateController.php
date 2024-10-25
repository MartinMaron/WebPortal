<?php

namespace App\Http\Controllers\Web;

use App\Models\Realestate;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Termwind\Components\Dd;

class RealestateController extends Controller
{

    /**
     * @return Factory|View|Application|\Illuminate\View\View
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
     * @param Realestate $realestate
     * @return Factory|View|Application|\Illuminate\View\View
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
