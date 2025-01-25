<?php

namespace App\Http\Controllers;

use App\Models\Ofi;
use App\Models\OfiResource;
use App\Models\OfiResourceController;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FormOfiController extends Controller
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
    public function index_add()
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
     * @param  \App\Models\OfiResourceController  $ofiResourceController
     * @return \Illuminate\Http\Response
     */
    public function show(OfiResourceController $ofiResourceController)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OfiResourceController  $ofiResourceController
     * @return \Illuminate\Http\Response
     */
    public function edit(OfiResourceController $osiResourceController)
    {
        $ofi = OfiResource::find();

        return view('formofi.edit', ['ofi' => $ofi]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OfiResourceController  $ofiResourceController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OfiResourceController $ofiResourceController)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OfiResourceController  $ofiResourceController
     * @return \Illuminate\Http\Response
     */
    public function destroy(OfiResourceController $ofiResourceController)
    {
        //
    }
}
