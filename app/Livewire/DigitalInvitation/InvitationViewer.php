<?php

namespace App\Livewire\DigitalInvitation;

use Livewire\Component;

class InvitationViewer extends Component {
    public $items = [];
    public $namaTamu = "Bowo & Selly";
    public $isButtonBasedView = true;

    public function mount() {
        $this->namaTamu = request()->query('guest') ? request()->query('guest'):'unknown';
        $this->isButtonBasedView = true;

        for ($i = 1; $i <= 28; $i++) {
            $content = '<h2 class="text-lg font-normal tracking-widest text-center uppercase animation-title">The Wedding Of '.$i.'</h2>
                        <h3 class="text-4xl font-medium tracking-widest text-center uppercase">Bima & Shinta</h3>
                        <div class="pt-4 space-y-1 font-light text-center">
                            <p>Kepada Yth:</p>
                            <p>Bapak/Ibu/Saudara/i</p>
                            <p class="font-semibold">{{guest}}</p>
                        </div>
                        <div class="p-4 text-center">
                            <button id="button-open-invitation" onclick="openInvitation()" class="px-4 py-2 text-sm text-center text-white duration-300 ease-in-out rounded-full hover:scale-105 bg-slate-500">Buka Undangan</button>
                        </div>';
        
            // Ganti placeholder dengan nama tamu
            $content = str_replace('{{guest}}', $this->namaTamu, $content);
        
            $this->items[] = [
                "menu" => "Opening $i",
                "content" => $content
            ];
        }
    }

    public function render() {
        return view('livewire.digital-invitation.invitation-viewer')->layout('components.layouts.invitation');
    }
}
