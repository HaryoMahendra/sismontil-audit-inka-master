<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DepartemenController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', '=', '3')->get();

        return view('departemen.index', ['users' => $users, 'title' => 'Departemen']);
    }

    public function index_add()
    {
        return view('departemen.add', ['title' => 'Departemen']);
    }

    public function store_add(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $validatedData['role'] = 'Auditee';
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('data-departemen');
    }

    public function index_edit(User $user)
    {
        return view('departemen.edit', ['user' => $user, 'title' => 'Departemen']);
    }

    public function store_edit(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'nip' => 'required',
            'name' => 'required',
            'username' => 'required',
        ]);

        if (!empty($request->password))
        {
            $validatedData['password'] = Hash::make($request->password);
        }

        User::where('id', '=', $user->id)->update($validatedData);

        return redirect('data-departemen');
    }

    public function delete(User $user)
    {
        User::where('id', '=', $user->id)->delete();

        return redirect('data-departemen')->with('swal_msg', 'Hapus Data Berhasil');
    }
}
