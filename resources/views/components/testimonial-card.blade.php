<div class="w-full h-full p-7 bg-white shadow-[0_4px_52.6px_rgba(0,0,0,0.09)] rounded-[20px] flex flex-col gap-6">
    <div class="flex justify-center items-center gap-1">
        @for($i = 0; $i < 5; $i++)
            <svg class="w-8 h-8 fill-[#E8EC01]" viewBox="0 0 24 24">
                <path d="M12 2L14.97 8.72L22.29 9.64L17 14.89L18.36 22.13L12 18.52L5.64 22.13L7 14.89L1.71 9.64L9.03 8.72L12 2Z" />
            </svg>
        @endfor
    </div>
    <div class="flex flex-col gap-2 text-center">
        <p class="text-[22px] font-extrabold">{{ $name }}</p>
        <p class="text-[20px] font-normal">{{ $message }}</p>
        @if(!empty($avatar))
            <img src="{{ $avatar }}" alt="{{ $name }}" class="w-10 h-10 rounded-full mx-auto" />
        @endif
    </div>
</div>
