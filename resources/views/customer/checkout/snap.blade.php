@extends('guest.layout')

@section('content')

<div class="max-w-2xl mx-auto py-20 text-center">

    <div class="bg-white rounded-2xl shadow p-10">

        <h2 class="text-2xl font-bold mb-4 text-[#F5AD1B]">
            Memproses Pembayaran
        </h2>

        <p class="text-gray-600 mb-6">
            Mohon tunggu, jendela pembayaran akan muncul otomatis.
        </p>

        <div class="animate-pulse text-gray-400">
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