@extends('customer.layout')

@section('content')

<div class="min-h-[70vh] flex items-center justify-center px-4">

    <div class="bg-white border rounded-2xl p-10 text-center max-w-md w-full shadow-sm">

        <!-- ICON LOADING -->
        <div class="flex justify-center mb-6">

            <div class="relative">

                <!-- SPINNER -->
                <div class="w-16 h-16 border-4 border-red-200 border-t-red-600 rounded-full animate-spin"></div>

                <!-- ICON CENTER -->
                <div class="absolute inset-0 flex items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-6 h-6 text-red-600"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                              d="M12 8c-1.657 0-3 1.343-3 3m0 0c0 1.657 1.343 3 3 3m-3-3h6"/>

                    </svg>

                </div>

            </div>

        </div>

        <!-- TITLE -->
        <h2 class="text-xl font-semibold text-gray-800 mb-2">
            Memproses Pembayaran
        </h2>

        <!-- DESC -->
        <p class="text-gray-500 text-sm mb-6 leading-relaxed">
            Mohon tunggu sebentar, kami sedang menghubungkan ke sistem pembayaran.
        </p>

        <!-- STATUS -->
        <div class="text-sm text-gray-400 animate-pulse">
            Menghubungkan ke Midtrans...
        </div>

    </div>

</div>

@endsection


{{-- ========================= --}}
{{-- MIDTRANS SNAP SCRIPT --}}
{{-- ========================= --}}
@if(isset($snapToken))

<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}">
</script>

<script>
    function payNow() {
        snap.pay('{{ $snapToken }}', {

            onSuccess: function(result){
                window.location.href = "/pesanan";
            },

            onPending: function(result){
                window.location.href = "/pesanan";
            },

            onError: function(result){
                alert("Pembayaran gagal.");
                window.location.href = "/pesanan";
            },

            onClose: function(){
                alert("Kamu menutup popup sebelum menyelesaikan pembayaran.");
                window.location.href = "/pesanan";
            }

        });
    }

    // Auto open popup
    window.onload = function() {
        payNow();
    };
</script>

@endif