<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Alamat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlamatController extends Controller
{
    public function index()
    {
        $alamats = Alamat::where('user_id', Auth::id())
            ->orderByDesc('is_primary')
            ->get();

        return view('customer.alamat.index', compact('alamats'));
    }

    public function create()
    {
        $count = Alamat::where('user_id', Auth::id())->count();

        if ($count >= 3) {
            return redirect()->route('alamat.index')
                ->with('error', 'Maksimal 3 alamat.');
        }

        return view('customer.alamat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_penerima' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:20',
            'alamat_lengkap' => 'required|string',
            'label' => 'required|in:rumah,kantor',
        ]);

        $count = Alamat::where('user_id', Auth::id())->count();

        if ($count >= 3) {
            return back()->with('error', 'Maksimal 3 alamat.');
        }

        $isPrimary = $count == 0 ? true : false;

        Alamat::create([
            'user_id' => Auth::id(),
            'nama_penerima' => $request->nama_penerima,
            'no_telepon' => $request->no_telepon,
            'alamat_lengkap' => $request->alamat_lengkap,
            'label' => $request->label,
            'is_primary' => $isPrimary,
        ]);

        return redirect()->route('alamat.index')
            ->with('success', 'Alamat berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $alamat = Alamat::where('user_id', Auth::id())
            ->findOrFail($id);

        return view('customer.alamat.edit', compact('alamat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_penerima' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:20',
            'alamat_lengkap' => 'required|string',
            'label' => 'required|in:rumah,kantor',
        ]);

        $alamat = Alamat::where('user_id', Auth::id())
            ->findOrFail($id);

        $alamat->update([
            'nama_penerima' => $request->nama_penerima,
            'no_telepon' => $request->no_telepon,
            'alamat_lengkap' => $request->alamat_lengkap,
            'label' => $request->label,
        ]);

        return redirect()->route('alamat.index')
            ->with('success', 'Alamat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $alamat = Alamat::where('user_id', Auth::id())
            ->findOrFail($id);

        $count = Alamat::where('user_id', Auth::id())->count();

        if ($count <= 1) {
            return back()->with('error', 'Minimal harus memiliki 1 alamat.');
        }

        $wasPrimary = $alamat->is_primary;

        $alamat->delete();

        if ($wasPrimary) {
            $newPrimary = Alamat::where('user_id', Auth::id())->first();
            if ($newPrimary) {
                $newPrimary->update(['is_primary' => true]);
            }
        }

        return back()->with('success', 'Alamat berhasil dihapus.');
    }

    public function setPrimary($id)
    {
        $alamat = Alamat::where('user_id', Auth::id())
            ->findOrFail($id);

        Alamat::where('user_id', Auth::id())
            ->update(['is_primary' => false]);

        $alamat->update(['is_primary' => true]);

        return back()->with('success', 'Alamat utama diperbarui.');
    }
}