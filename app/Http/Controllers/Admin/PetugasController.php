<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; 

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = User::where('role', 'petugas')
            ->latest()
            ->paginate(10);

        return view('admin.petugas.index', compact('petugas'));
    }

    public function create()
    {
        return view('admin.petugas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'petugas'
        ]);

        return redirect()->route('admin.petugas.index')
            ->with('success', 'Petugas berhasil ditambahkan');
    }

    public function edit($id)
    {
        $petugas = User::findOrFail($id);
        return view('admin.petugas.edit', compact('petugas'));
    }

    public function update(Request $request, $id)
    {
        $petugas = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $petugas->update($data);

        return redirect()->route('admin.petugas.index')
            ->with('success', 'Petugas berhasil diupdate');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->role !== 'petugas') {
            return back()->with('error', 'Hanya petugas yang bisa dihapus');
        }

        if (Auth::id() == $id) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri');
        }

        $user->delete();

        return back()->with('success', 'Petugas dihapus');
    }
}