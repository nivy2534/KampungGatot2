<div class="w-[310px] h-[346px] flex flex-col items-center gap-4">
    <div class="w-full flex-1 rounded-xl bg-white p-6 bg-cover bg-center relative overflow-hidden" style="background-image: url('{{ $image }}')">
        <div class="absolute top-4 left-4 bg-[#F2F2F2] rounded px-3 py-1 inline-flex items-center">
            <span class="text-[#33AD5C] font-bold text-[16px]">BIG DEALS</span>
        </div>
    </div>
    <div class="w-full flex flex-col items-start gap-2">
        <div class="text-[#717171] text-[16px] font-medium">{{ $date }}</div>
        <div class="text-black text-[20px] font-semibold">{{ $title }}</div>
        <div class="text-[#1B3A6D] text-[20px] font-semibold">{{ $price }}</div>
    </div>
</div>
