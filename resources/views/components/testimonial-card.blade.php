<div class="bg-white shadow-lg rounded-lg p-4 hover:shadow-xl transition-shadow duration-300 h-full flex flex-col">
    <!-- Star Rating -->
    <div class="flex justify-center items-center gap-1 mb-4">
        @for($i = 0; $i < 5; $i++)
            <svg class="w-4 h-4 fill-yellow-400" viewBox="0 0 24 24">
                <path d="M12 2L14.97 8.72L22.29 9.64L17 14.89L18.36 22.13L12 18.52L5.64 22.13L7 14.89L1.71 9.64L9.03 8.72L12 2Z" />
            </svg>
        @endfor
    </div>
    
    <!-- Message -->
    <div class="flex-1 flex flex-col justify-center">
        <blockquote class="text-gray-700 text-center text-sm leading-relaxed mb-4 italic">
            "{{ $message ?? 'Pesan testimoni akan ditampilkan di sini.' }}"
        </blockquote>
    </div>
    
    <!-- User Info -->
    <div class="flex flex-col items-center space-y-2 border-t border-gray-100 pt-4">
        @if(!empty($avatar))
            <img src="{{ $avatar }}" alt="{{ $name ?? 'User' }}" class="w-10 h-10 rounded-full object-cover border-2 border-gray-200" />
        @else
            <div class="w-10 h-10 rounded-full bg-[#1B3A6D] flex items-center justify-center text-white font-bold text-sm">
                {{ strtoupper(substr($name ?? 'U', 0, 1)) }}
            </div>
        @endif
        <div class="text-center">
            <h4 class="font-bold text-gray-900 text-base">{{ $name ?? 'Nama Pengguna' }}</h4>
            <p class="text-xs text-gray-500">{{ $role ?? 'Warga Kampung Gatot' }}</p>
        </div>
    </div>
</div>
