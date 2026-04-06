@php
    $lastLabel = null;
@endphp

@foreach($notifications as $notif)

    @php
        $date = $notif->created_at;

        if ($date->isToday()) {
            $label = 'Hari Ini';
        } elseif ($date->isYesterday()) {
            $label = 'Kemarin';
        } else {
            $label = $date->translatedFormat('d F Y');
        }
    @endphp

    <!-- GROUP LABEL -->
    @if ($label !== $lastLabel)
        <div class="mt-8 mb-3">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">
                {{ $label }}
            </p>
        </div>
        @php $lastLabel = $label; @endphp
    @endif

    @php
        $type = $notif->type;

        $config = match($type) {
            'checkout' => [
                'color' => 'bg-blue-50 border-blue-200 text-blue-600',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 6h13M10 21a1 1 0 100-2 1 1 0 000 2zm7 0a1 1 0 100-2 1 1 0 000 2z"/>
                        </svg>'
            ],
            'status' => [
                'color' => 'bg-yellow-50 border-yellow-200 text-yellow-600',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13l4 4L19 7"/>
                        </svg>'
            ],
            'payment' => [
                'color' => 'bg-red-50 border-red-200 text-red-600',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"/>
                        </svg>'
            ],
            default => [
                'color' => 'bg-gray-50 border-gray-200 text-gray-600',
'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4 4v5h5M20 20v-5h-5M5 9a7 7 0 0112-3M19 15a7 7 0 01-12 3"/>
          </svg>'
            ],
        };
    @endphp

    <!-- CARD -->
    <div class="bg-white rounded-xl border hover:shadow-md transition mb-4 overflow-hidden">
        <div class="flex items-start gap-4 p-4">

            <!-- ICON -->
            <div class="p-2 rounded-lg border {{ $config['color'] }}">
                {!! $config['icon'] !!}
            </div>

            <!-- CONTENT -->
            <div class="flex-1">
                <p class="font-semibold text-gray-800 text-sm md:text-base">
                    {{ $notif->title }}
                </p>

                <p class="text-sm text-gray-600 mt-1 leading-relaxed">
                    {{ $notif->message }}
                </p>
            </div>

            <!-- TIME -->
            <div class="text-xs text-gray-400 whitespace-nowrap">
                {{ $notif->created_at->diffForHumans() }}
            </div>

        </div>
    </div>

@endforeach