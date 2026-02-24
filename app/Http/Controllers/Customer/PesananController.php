<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function index(Request $request)
    {
        $query = Pesanan::with([
            'user',
            'alamat',
            'details.produk'
        ])->where('user_id', Auth::id());

        // FILTER TANGGAL
        if ($request->from) {
            $query->whereDate('created_at', '>=', $request->from);
        }

        if ($request->to) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        // FILTER STATUS
        if ($request->payment_status) {
            $query->where('payment_status', $request->payment_status);
        }

        if ($request->order_status) {
            $query->where('order_status', $request->order_status);
        }

        $pesanans = $query->latest()->get();

        return view('customer.pesanan.index', compact('pesanans'));
    }
}