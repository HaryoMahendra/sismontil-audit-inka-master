<?php

namespace App\Http\Controllers;

use App\Models\Tema;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TemaController extends Controller
{
    public function index()
    {
        $tema = Tema::all();

        return view('tema.index', compact('tema'));
    }

    public function create()
    {
        return view('tema.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_tema' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator)->with('error', 'Masukkan data dengan benar');
        } else {
            Tema::create([
                'nama_tema' => $request->nama_tema
            ]);

            return redirect()->route('tema.index')->with('success', 'Berhasil menambahkan tema !');
        }
    }

    public function destroy($id)
    {
        try {
            Tema::where('id', $id)->delete();
            // TLNcr::where('id_ncr', $id)->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus data !');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal menghapus data !');
        }
    }


    public function edit(Tema $tema)
    {
        return view('tema.edit', ['tema' => $tema, 'title' => 'Tema']);
    }


    public function update(Request $request, Tema $tema)
    {
        $validatedData = $request->validate([
            'nama_tema' => 'required',
        ]);

        Tema::where('id', $tema->id)->update($validatedData);

        return redirect()->route('tema.index')->with('success', 'Data berhasil diedit!');
    }
}
