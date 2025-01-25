<?php

namespace App\Http\Controllers;

use App\Models\Ncr;
use App\Models\NcrResource;
use App\Models\NcrResourceController;
use Illuminate\Http\Request;

class FormNcrController extends Controller
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
     * @param  \App\Models\NcrResourceController  $ncrResourceController
     * @return \Illuminate\Http\Response
     */
    public function show(NcrResourceController $ncrResourceController)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NcrResourceController  $ncrResourceController
     * @return \Illuminate\Http\Response
     */
    public function edit(NcrResourceController $ncrResourceController)
    {
        $ncr = NcrResource::find();

        return view('formncr.edit', ['ncr' => $ncr]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NcrResourceController  $ncrResourceController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NcrResourceController $ncrResourceController)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NcrResourceController  $ncrResourceController
     * @return \Illuminate\Http\Response
     */
    public function destroy(NcrResourceController $ncrResourceController)
    {
        //
    }
}
