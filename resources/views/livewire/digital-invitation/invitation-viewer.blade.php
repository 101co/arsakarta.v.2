<div class="relative w-full h-full bg-yellow-200 bg-cover" style="background-image: url('{{ asset('storage/arsakarta/assets/theme/simple/background001.jpg') }}');">
    @if ($activeIndex == 0)
        {!! $page1 !!}
    @elseif ($activeIndex == 1)
        {!! $page2 !!}
    @elseif ($activeIndex == 2)
        {!! $page3 !!}
    @endif

    <div id="bottom-navigation" class="absolute bottom-0 left-0 w-full px-2 pt-3 mb-2">
        <div class="px-4 py-6 overflow-x-auto bg-white rounded-2xl scrollbar-hidden">
            <div class="flex justify-between space-x-4 overflow-hidden whitespace-nowrap">
                @foreach ($visibleItems as $index => $item)
                <a href="#" class="flex flex-col items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100 hover:shadow-lg transition-all duration-300 ease-in-out transform {{ ($activeIndex == ($currentIndex + $index)) ? 'bg-green-200 font-bold' : '' }}""
                    wire:click.prevent="selectItem({{ $currentIndex + $index }})">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span class="text-xs">{{ $item }}</span>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>