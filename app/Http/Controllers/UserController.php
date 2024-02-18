<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Apply search
        if ($request->filled('search_keyword')) {
            $keyword = $request->input('search_keyword');
            $query->search($keyword);
        }

        // Apply role filter
        if ($request->filled('role')) {
            $role = $request->input('role');
            $query->FilterByRole($role);
        }

        // Get the final result
        $users = $query->get();

        return view('dashboard.admin.user.index', [
            'title' => 'Manajemen Pengguna',
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.admin.user.create', [
            'title' => 'Manajemen Pengguna',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'max:100', 'min:3'],
            'email' => ['email', 'required', 'max:100'],
            'role' => ['required'],
            'username' => ['required', 'max:25', 'min:3'],
            'password' => ['min:8', 'required', 'max:100'],
            'id_no' => ['required', 'max:10', 'min:10']
        ], [
            'name.required' => 'Nama harus diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 100 karakter.',
            'name.min' => 'Nama minimal harus terdiri dari 3 karakter.',
            'email.email' => 'Format email tidak valid.',
            'email.required' => 'Email harus diisi.',
            'email.max' => 'Email tidak boleh lebih dari 100 karakter.',
            'id_no.max' => 'NIS/NIP tidak boleh lebih dari 10 karakter.',
            'id_no.min' => 'NIS/NIP minimal harus terdiri dari 10 karakter.',
            'id_no.required' => 'NIS/NIP harus diisi.',
            'role.required' => 'Role harus dipilih.',
            'username.required' => 'Username harus diisi.',
            'username.max' => 'Username tidak boleh lebih dari 25 karakter.',
            'username.min' => 'Username minimal harus terdiri dari 3 karakter.',
            'password.min' => 'Password minimal harus terdiri dari 8 karakter.',
            'password.required' => 'Password harus diisi.',
            'password.max' => 'Password tidak boleh lebih dari 100 karakter.'
        ]);
        // password hash
        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);

        // succes
        return redirect('/users-management')->with('success', 'Akun berhasil dibuat!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, User $user)
    {
        return view('dashboard.admin.user.show', [
            'user' => User::where('id', $request->id)->get(),
            'title' => 'Member Management'
        ]);
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        return view('dashboard.admin.user.edit', [
            'user' => User::where('id', $request->id)->get(),
            'title' => 'Member Management'
        ]);
        // return dd($request->id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'max:100', 'min:3'],
            'email' => 'required|email|max:100|unique:users,email,' . $request->id,
            'username' => 'required|min:3|max:100|unique:users,username,' . $request->id,
            'id_no' => 'required|min:10|max:10|unique:users,id_no,' . $request->id,
            'role' => ['required'],
            'id' => ['required']
        ], [
            'name.required' => 'Nama harus diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 100 karakter.',
            'name.min' => 'Nama minimal harus terdiri dari 3 karakter.',
            'email.email' => 'Format email tidak valid.',
            'email.required' => 'Email harus diisi.',
            'email.unique' => 'Email telah digunakan',
            'email.max' => 'Email tidak boleh lebih dari 100 karakter.',
            'id_no.max' => 'NIS/NIP tidak boleh lebih dari 10 karakter.',
            'id_no.min' => 'NIS/NIP minimal harus terdiri dari 10 karakter.',
            'id_no.required' => 'NIS/NIP harus diisi.',
            'id_no.unique' => 'NIS/NIP telah terdaftar.',
            'role.required' => 'Role harus dipilih.',
            'username.required' => 'Username harus diisi.',
            'username.max' => 'Username tidak boleh lebih dari 25 karakter.',
            'username.min' => 'Username minimal harus terdiri dari 3 karakter.',
            'username.unique' => 'Username telah digunakan',
        ]);

        User::where('id', $request->id)->update($validatedData);
        return redirect('/users-management')->with('successEdit', 'Profile pengguna berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        User::destroy($request->id);
        return redirect('/users-management')->with('successDelete', 'Akun berhasil dihapus!');
    }
}
