@extends('customer.layout')

@section('content')

<div class="max-w-4xl mx-auto pt-6 pb-10 px-4 md:px-6">

    <!-- HEADER -->
<div class="flex items-center gap-3 mb-8">

    <!-- BACK BUTTON -->
<a href="#"
   onclick="event.preventDefault(); 

        if (document.referrer) {
            window.location.href = document.referrer;
        } else {
            window.location.href='{{ route('dashboard') }}';
        }

   "
   class="p-1 rounded-lg text-gray-600 hover:text-red-600 hover:bg-gray-100 transition">

    <svg xmlns="http://www.w3.org/2000/svg" 
         class="w-6 h-6" 
         fill="none" 
         viewBox="0 0 24 24" 
         stroke="currentColor">

        <path stroke-linecap="round" 
              stroke-linejoin="round" 
              stroke-width="2" 
              d="M15 19l-7-7 7-7"/>
    </svg>
</a>

    <!-- TITLE -->
    <h2 class="text-xl md:text-2xl font-semibold text-gray-800">
        Notifikasi
    </h2>

</div>
    

    <!-- 🔥 LIST NOTIF -->
    <div id="notification-list">

        @if($notifications->isEmpty())
            <div class="flex flex-col items-center justify-center text-center py-20">

                <!-- ICON -->
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-16 h-16 text-gray-300 mb-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.5"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14V11a6 6 0 10-12 0v3c0 .386-.149.735-.405 1.0L4 17h5m6 0a3 3 0 11-6 0"/>
                </svg>

                <!-- TEXT -->
                <p class="text-gray-500 text-sm">
                    Belum ada notifikasi
                </p>

                <p class="text-gray-400 text-xs mt-1">
                    Notifikasi akan muncul di sini
                </p>

            </div>
        @else
            @include('customer.notifications.partials', ['notifications' => $notifications])
        @endif

    </div>

    <!-- 🔥 LOAD MORE BUTTON -->
@if ($notifications->hasMorePages())
    <div class="flex justify-center mt-8">
        <button id="load-more"
            class="flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white text-sm font-medium rounded-xl shadow-md hover:shadow-lg hover:scale-[1.02] active:scale-95 transition-all duration-200">

            <!-- ICON -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 opacity-90" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9M20 20v-5h-.581m0 0A8.003 8.003 0 016.582 15"/>
            </svg>

            <span>Load More</span>

        </button>
    </div>
@endif

</div>

<!-- 🔥 SCRIPT LAZY LOAD -->
<script>
let page = 2;
let loading = false;

document.getElementById('load-more')?.addEventListener('click', async () => {

    if (loading) return;
    loading = true;

    let btn = document.getElementById('load-more');
    btn.innerText = 'Loading...';

    try {
        let response = await fetch(`{{ route('notifications.load') }}?page=${page}`);
        let data = await response.text();

        if (data.trim()) {
            document.getElementById('notification-list')
                .insertAdjacentHTML('beforeend', data);

            page++;
            btn.innerText = 'Load More';
        } else {
            btn.remove(); // 🔥 kalau sudah habis
        }

    } catch (e) {
        btn.innerText = 'Error';
    }

    loading = false;
});
</script>

@endsection