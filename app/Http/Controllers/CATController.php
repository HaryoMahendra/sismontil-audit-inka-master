<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CAT;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CATExport;
use Illuminate\Support\Facades\Auth;


class CATController extends Controller
{
    public function index()
    {
        $catList = \App\Models\Cat::orderBy('tanggal', 'desc')->get();
        return view('cat.index', compact('catList'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'is_cat' => 'required',
            'departemen' => 'required',
            'format_cat_penyelidikan' => 'nullable|string',
            'format_cat_perbaikan' => 'nullable|string',
            'format_cat_rencana' => 'nullable|string',
            'verifikator' => 'required',
            'tanggal_penyelidikan' => 'required|date',
        ]);

        \App\Models\Cat::create([
            'is_cat' => $request->is_cat,
            'departemen' => $request->departemen,
            'penyelidikan' => $request->format_cat_penyelidikan,
            'perbaikan' => $request->format_cat_perbaikan,
            'rencana' => $request->format_cat_rencana,
            'verifikator' => $request->verifikator,
            'tanggal' => $request->tanggal_penyelidikan,
        ]);

        return redirect()->route('cat.index')->with('success', 'Data CAT berhasil disimpan');
    }

    public function add()
    {
        return view('cat.add');
    }

   public function exportExcel()
{
    $catList = Cat::all(); 
    return view('cat.excel', compact('catList'));
}




    public function show($id)
    {
        $cat = Cat::findOrFail($id);
        return view('cat.show', compact('cat'));
    }

    public function edit($id)
    {
        $cat = Cat::findOrFail($id);
        return view('cat.edit', compact('cat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'is_cat' => 'required',
            'departemen' => 'required',
            'format_cat_penyelidikan' => 'nullable|string',
            'format_cat_perbaikan' => 'nullable|string',
            'format_cat_rencana' => 'nullable|string',
            'verifikator' => 'required',
            'tanggal_penyelidikan' => 'required|date',
        ]);

        $cat = Cat::findOrFail($id);
        $cat->update([
            'is_cat' => $request->is_cat,
            'departemen' => $request->departemen,
            'penyelidikan' => $request->format_cat_penyelidikan,
            'perbaikan' => $request->format_cat_perbaikan,
            'rencana' => $request->format_cat_rencana,
            'verifikator' => $request->verifikator,
            'tanggal' => $request->tanggal_penyelidikan,
        ]);

        return redirect()->route('cat.index')->with('success', 'Data CAT berhasil diperbarui');
    }

    public function destroy($id)
    {
        $cat = Cat::findOrFail($id);
        $cat->delete();

        return redirect()->route('cat.index')->with('success', 'Data CAT berhasil dihapus');
    }



    // public function excel()
    //     {
    //         $data = $this->getAPI();
    //         if (auth()->user()->role->role == 'Wakil Manajemen') {
    //             $cat = CAT::where('objek_audit', '=', auth()->user()->departement_id)->get();
    //         } elseif (auth()->user()->role->role == 'Auditor') {
    //             $cat = CAT::where('id_auditor', Auth::user()->id)->get();
    //         } else {
    //             $cat = CAT::all();
    //         }

    //         return view('cat.excel', ['ncr' => $cat, 'departemen' => $data]);
    //     }

}
