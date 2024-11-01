@if ($isButtonBasedView)
<div id="content" class="h-screen max-w-lg px-2 py-2 mx-auto">
    <div class="flex items-center justify-center w-full h-full overflow-hidden bg-white rounded-3xl">
        <div class="w-full h-full">
            <div class="relative w-full h-full bg-cover bg-[#3d1f17]" > {{--style="background-image: url('{{ asset('storage/arsakarta/assets/theme/simple/background001.jpg') }}');">--}}
                @foreach ($items as $index => $item)
                <div id="page{{$index}}" class="{{$index == 0 ? 'relative':''}} z-40 flex items-center justify-center h-full overflow-hidden bg-cover content-page rounded-xl bg-[#3d1f17]"> {{--style="background-image: url('{{ asset('storage/arsakarta/assets/theme/simple/background001.jpg') }}');">--}}
                    <div class="p-4 space-y-4">
                        {!! $item['content'] !!}
                        
                        {{-- ornamen pada cover undangan --}}
                        <div id="ornament-cover" class="absolute left-0 hidden w-full h-20 overflow-hidden ornament-cover -top-5">
                            <img src="{{ asset('storage/asset-invitation/javanese-ornamen-1.png') }}" class="object-cover w-full h-auto" alt="Gambar Kiri Atas">
                        </div>
                        <div id="ornament-cover" class="absolute left-0 hidden w-full h-20 overflow-hidden ornament-cover bottom-1">
                            <img src="{{ asset('storage/asset-invitation/javanese-ornamen-1.png') }}" class="object-cover w-full h-auto" alt="Gambar Kiri Atas">
                        </div>
                        
                        
                        {{-- ornamen pada halaman undangan --}}
                        <img id="object-tl" src="{{ asset('storage/asset-invitation/javanese-leaf.png') }}" class="absolute ornament -top-[8%] -left-[5%] w-[25%] transform rotate-[145deg]" alt="Gambar Kiri Atas">
                        <img id="object-tr" src="{{ asset('storage/asset-invitation/javanese-leaf.png') }}" class="absolute ornament -top-[8%] -right-[5%] w-[25%] transform rotate-[-145deg]" alt="Gambar Kanan Atas">
                        <img id="object-bl" src="{{ asset('storage/asset-invitation/javanese-leaf.png') }}" class="absolute ornament w-[25%] transform rotate-[55deg] bottom-20 -left-[8%]" alt="Gambar Kiri Bawah">
                        <img id="object-br" src="{{ asset('storage/asset-invitation/javanese-leaf.png') }}" class="absolute ornament bottom-20 -right-[8%] w-[25%] transform rotate-[-55deg]" alt="Gambar Kanan Bawah">
                        <img id="object-ct" src="{{ asset('storage/asset-invitation/javanese-line-hr.png') }}" class="absolute top-0 w-[40%] transform -translate-x-1/2 ornament left-1/2" alt="Gambar Tengah Atas">
                        <img id="object-cb" src="{{ asset('storage/asset-invitation/javanese-line-hr.png') }}" class="absolute w-[55%] transform -translate-x-1/2 bottom-[120px] ornament left-1/2" alt="Gambar Tengah Bawah">
                        <img id="object-cl" src="{{ asset('storage/asset-invitation/javanese-line-vr.png') }}" class="absolute h-[50%] transform -translate-y-[75%] left-3 ornament top-1/2" alt="Gambar Tengah Kiri">
                        <img id="object-cr" src="{{ asset('storage/asset-invitation/javanese-line-vr.png') }}" class="absolute h-[50%] transform -translate-y-[75%] right-3 ornament top-1/2" alt="Gambar Tengah Kanan">
                    </div>
                </div>
                @endforeach
            
                <div id="bottom-navigation" class="absolute bottom-0 left-0 z-50 w-full px-2 pt-3 mb-2">
                    <div class="px-2 py-2 bg-white shadow-md rounded-2xl">
                        <div id="navigation-container" class="relative overflow-hidden">
                            <div id="nav-items" class="flex transition-transform duration-300" style="min-width: 300%;">
                                @foreach ($items as $index => $item)
                                    <button class="nav-item flex flex-col items-center justify-center space-y-2 h-full py-4 text-gray-700 transition-all duration-300 ease-in-out transform rounded-lg {{ $index == 0 ? 'bg-slate-100' : '' }}" data-index="{{ $index }}" onclick="selectItem({{ $index }})" style="flex: 0 0 calc(100% / 15);">
                                        <ion-icon name="{{ $item['icon'] }}" class="size-6 text-slate-600"></ion-icon>
                                        <span class="text-xs text-center text-slate-600">{{ $item['menu'] }}</span>
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Floating Icons -->
                <div id="media-button" class="absolute z-50 flex flex-col space-y-3 bottom-32 right-4">
                    <a href="#">
                        <ion-icon class="items-center p-4 text-xl text-white ease-in-out rounded-full cursor-pointer opacity-55 bg-slate-400 hover:bg-slate-500" name="qr-code-outline"></ion-icon>
                    </a>
                    <a href="#">
                        <ion-icon class="items-center p-4 text-xl text-white ease-in-out rounded-full cursor-pointer opacity-55 bg-slate-400 hover:bg-slate-500" name="volume-high-outline"></ion-icon>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div id="content" class="max-w-lg mx-auto">
    <div class="flex flex-col items-center justify-center w-full h-full overflow-hidden bg-white">
        <div id="page-1" class="flex items-center justify-center w-full h-screen overflow-hidden bg-yellow-200">
            <h1>Scroll Based</h1>
        </div>
    </div>
    <div class="flex flex-col items-center justify-center w-full h-full overflow-hidden bg-white">
        <div id="page-2" class="flex items-center justify-center w-full h-screen overflow-hidden bg-yellow-300">
            <h1>Scroll Based 2</h1>
        </div>
    </div>
    <!-- Floating Icons -->
    <div id="media-button" class="fixed z-50 flex-col hidden space-y-3 bottom-32 right-4">
        <a href="#">
            <ion-icon class="items-center p-4 text-xl text-white ease-in-out rounded-full cursor-pointer opacity-55 bg-slate-400 hover:bg-slate-500" name="qr-code-outline"></ion-icon>
        </a>
        <a href="#">
            <ion-icon class="items-center p-4 text-xl text-white ease-in-out rounded-full cursor-pointer opacity-55 bg-slate-400 hover:bg-slate-500" name="volume-high-outline"></ion-icon>
        </a>
    </div>
</div>
@endif