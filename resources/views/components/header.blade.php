<header class="w-full bg-[#F5F5F5] px-[50px] h-[100px] flex items-center justify-between">
    {{-- Left logo + desa info --}}
    <div class="flex items-center gap-[10px] h-[70px]">
        <img src="{{ asset('assets/img/logo_ngebruk.png') }}" alt="Logo" class="w-[70px] h-[70px]" />
        <div class="flex flex-col justify-center">
            <div class="text-[#080808] text-[18px] leading-[28px] font-bold font-['Inter']">
                Desa Ngebruk
            </div>
            <div class="text-[#080808] text-[12px] leading-[20px] font-normal font-['Inter']">
                Kecamatan Sumberpucung
            </div>
        </div>
    </div>

    {{-- Navigation & Login --}}
    <div class="w-[878px] flex justify-between items-center">
        {{-- Nav links --}}
        <nav class="w-[465px] flex justify-center items-center gap-[52px]">
            <a href="/" class="border-b-2 border-[#1B3A6D] text-black text-[20px] leading-[28px] font-semibold font-['Plus Jakarta Sans']">
                Home
            </a>
            <a href="{{ route('blog') }}" class="text-black text-[20px] leading-[28px] font-medium font-['Plus Jakarta Sans']">
                Blog
            </a>
            <a href="/galeri" class="text-black text-[20px] leading-[28px] font-medium font-['Plus Jakarta Sans']">
                Galeri
            </a>
            <a href="/belanja" class="text-black text-[20px] leading-[28px] font-medium font-['Plus Jakarta Sans']">
                Belanja
            </a>
        </nav>

        {{-- Login Button --}}
        <a href="/login"
           class="w-[121px] h-[48px] px-6 py-3 bg-[#1B3A6D] rounded-[8px] flex items-center justify-center text-white text-[16px] leading-[24px] font-semibold font-['Plus Jakarta Sans']">
            Login
        </a>
    </div>
</header>
