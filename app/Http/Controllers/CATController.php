<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CAT;

class CATController extends Controller
{
    public function index()
    {
        return view('cat.index');
    }

   public function store(Request $request)
{
    $tipe = $request->input('tipe_data_audit');

    if ($tipe === 'OFI') {
        $request->validate([
            'deskripsi_ofi' => 'required|string',
            'tindakan_ofi' => 'required|string',
        ]);

        CAT::create([
            'tipe_data_audit' => 'OFI',
            'deskripsi_ofi' => $request->deskripsi_ofi,
            'tindakan_ofi' => $request->tindakan_ofi,
        ]);
    }

    if ($tipe === 'NCR') {
        $request->validate([
            'deskripsi_ncr' => 'required|string',
            'tindakan_ncr' => 'required|string',
        ]);

        CAT::create([
            'tipe_data_audit' => 'NCR',
            'deskripsi_ofi' => $request->deskripsi_ncr,
            'temuan_ncr'    => $request->temuan_ncr, 
            'tindakan_ncr' => $request->tindakan_ncr, 
        ]);
    }

    return redirect()->route('cat.index')->with('success', 'Data berhasil disimpan!');
}
}

