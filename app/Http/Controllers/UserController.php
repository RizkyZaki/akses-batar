<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Pengguna';
        $data = User::where('role', '!=', \App\Enums\UserRole::Pharmacy_Management)->latest()->get();

        return view('pages.users.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.users.create', [
            'title' => 'Buat Pengguna',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'role' => 'required',
        ], [
            'name.required' => 'Nama Wajib Diisi',
            'email.required' => 'Email Wajib Diisi',
            'email.unique' => 'Email Sudah Ada',
            'password.required' => 'Password Wajib Diisi',
            'role.required' => 'Hak Akses Wajib Diisi',
        ]);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ];
        User::create($data);
        notify()->success('Data Berhasil Dimasukkan');
        return redirect('dashboard/users');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::find(hashidDecode($id))->first();
        return view('pages.users.update', [
            'title' => 'Ubah Pengguna',
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find(hashidDecode($id))->first();
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'role' => 'required',
        ], [
            'name.required' => 'Nama Wajib Diisi',
            'email.required' => 'Email Wajib Diisi',
            'email.unique' => 'Email Sudah Ada',
            'password.required' => 'Password Wajib Diisi',
            'role.required' => 'Hak Akses Wajib Diisi',
        ]);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ];
        $user->update($data);
        notify()->success('Data Berhasil Dimasukkan');
        return redirect('dashboard/users');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $User = User::find(hashidDecode($id))->first();

        $User->delete();

        notify()->success('Data Berhasil Dihapus');

        return redirect('dashboard/users');
    }
}