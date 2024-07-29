<div class="card h-full">
   <div class="card-body p-4 rounded-xl bg-white/35 shadow-xl">
      <div class="flex justify-between items-center mb-2 w-full">
         <div class="text-gray-600 border-gray-400 hover:border-b">
            <a href="{{ $titleLink }}" class="me-1 font-bold">{{ $title }}</a>
            <i class="fa-solid fa-chevron-right text-[0.7rem]"></i>
         </div>
         <div>
            <span class="font-bold text-xl">{{ $totalAllergy }}</span>
         </div>
      </div>
      {{ $slot }}
   </div>
</div>
