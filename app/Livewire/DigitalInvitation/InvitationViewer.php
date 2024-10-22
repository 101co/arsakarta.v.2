<?php

namespace App\Livewire\DigitalInvitation;

use Livewire\Component;

class InvitationViewer extends Component {
    public $items = [];
    public $visibleItems = [];
    public $currentIndex = 0;
    public $itemsPerPage = 5;
    public $activeIndex = null;

    // dummy pages
    public $page1 = '<div class="flex items-center justify-center h-full overflow-hidden bg-cover rounded-xl" style="background-image: url(\'{{ asset(\'storage/arsakarta/assets/theme/simple/background001.jpg\') }}\');">
        <div class="p-4 space-y-4">
            <h2 class="text-lg font-normal tracking-widest text-center uppercase animation-title">The Wedding Of</h2>
            <h3 class="text-4xl font-medium tracking-widest text-center uppercase">Bima & Shinta</h3>
            <div class="pt-4 space-y-1 font-light text-center">
                <p>Kepada Yth:</p>
                <p>Bapak/Ibu/Saudara/i</p>
                <p class="font-semibold">Nama Tamu</p>
            </div>
            <div class="p-4 text-center">
                <button class="px-4 py-2 text-sm text-center text-white duration-300 ease-in-out rounded-full hover:scale-105 bg-slate-500">Buka Undangan</button>
            </div>
        </div>
    </div>';
    public $page2 = '<div class="flex items-center justify-center h-full overflow-hidden bg-cover rounded-xl" style="background-image: url(\'{{ asset(\'storage/arsakarta/assets/theme/simple/background001.jpg\') }}\');">
        <div class="p-4 space-y-4">
            <h2 class="text-lg font-normal tracking-widest text-center uppercase animation-title">Halaman 2</h2>
            <h3 class="text-4xl font-medium tracking-widest text-center uppercase">Bima & Shinta</h3>
            <div class="pt-4 space-y-1 font-light text-center">
                <p>Kepada Yth:</p>
                <p>Bapak/Ibu/Saudara/i</p>
                <p class="font-semibold">Nama Tamu</p>
            </div>
            <div class="p-4 text-center">
                <button class="px-4 py-2 text-sm text-center text-white duration-300 ease-in-out rounded-full hover:scale-105 bg-slate-500">Buka Undangan</button>
            </div>
        </div>
    </div>';
    public $page3 = '<div class="flex items-center justify-center h-full overflow-hidden bg-cover rounded-xl" style="background-image: url(\'{{ asset(\'storage/arsakarta/assets/theme/simple/background001.jpg\') }}\');">
        <div class="p-4 space-y-4">
            <h2 class="text-lg font-normal tracking-widest text-center uppercase animation-title">Halaman 3</h2>
            <h3 class="text-4xl font-medium tracking-widest text-center uppercase">Bima & Shinta</h3>
            <div class="pt-4 space-y-1 font-light text-center">
                <p>Kepada Yth:</p>
                <p>Bapak/Ibu/Saudara/i</p>
                <p class="font-semibold">Nama Tamu</p>
            </div>
            <div class="p-4 text-center">
                <button class="px-4 py-2 text-sm text-center text-white duration-300 ease-in-out rounded-full hover:scale-105 bg-slate-500">Buka Undangan</button>
            </div>
        </div>
    </div>';

    public function refreshComponent() {
        $this->dispatch('refreshAnimation');
    }

    public function mount() {
        // Mengisi item dengan contoh data
        for ($i = 1; $i <= 15; $i++) {
            $this->items[] = "Menu $i";
        }
        // Mengambil item yang akan ditampilkan
        $this->updateVisibleItems();
    }

    public function updateVisibleItems() {
        // Menampilkan item yang terlihat berdasarkan currentIndex
        $this->visibleItems = array_slice($this->items, $this->currentIndex, $this->itemsPerPage);
    }

    public function loadNext() {
        // Jika item yang dipilih adalah ke-4, pindahkan ke posisi tengah (3)
        if ($this->currentIndex + 3 < count($this->items)) {
            $this->currentIndex += 1; // Maju satu menu
            $this->updateVisibleItems();
        }
    }

    public function loadPrevious() {
        // Jika item yang dipilih adalah ke-2, pindahkan ke posisi tengah (3)
        if ($this->currentIndex - 1 >= 0) {
            $this->currentIndex -= 1; // Mundur satu menu
            $this->updateVisibleItems();
        }
    }

    public function selectItem($index) {
        // Menempatkan item yang dipilih ke posisi tengah
        $this->dispatch('livewire:init');
        $newIndex = $index - 2; // Karena item ke-3 (indeks 2) adalah posisi tengah
        $this->activeIndex = $index;
        if ($newIndex >= 0 && $newIndex <= count($this->items) - $this->itemsPerPage) {
            $this->currentIndex = $newIndex;
            $this->updateVisibleItems();
        }
    }

    public function render() {
        return view('livewire.digital-invitation.invitation-viewer')->layout('components.layouts.invitation');
    }
}
