<?php

namespace App\Livewire\DigitalInvitation;

use Livewire\Component;

class InvitationViewer extends Component {
    public $items = [];
    public $menus = [];

    public $namaTamu = "Bowo & Selly";
    public $namaMempelai = "Bima & Nadia";

    public $isButtonBasedView = true;
    public $page0;
    public $page1;

    public function mount() {
        $this->namaTamu = request()->query('guest') ? request()->query('guest'):'unknown';
        $this->isButtonBasedView = true;
        $this->menus = [
            ["menu" => "Opening",       "icon" => "home-sharp"], 
            ["menu" => "Salam",         "icon" => "chatbubbles"], 
            ["menu" => "Protokol",      "icon" => "shield"], 
            ["menu" => "Mempelai",      "icon" => "heart"], 
            ["menu" => "Acara",         "icon" => "diamond"], 
            ["menu" => "Galeri",        "icon" => "images"], 
            ["menu" => "Video",         "icon" => "videocam"], 
            ["menu" => "Love Story",    "icon" => "heart-circle"], 
            ["menu" => "Quote",         "icon" => "sparkles"], 
            ["menu" => "Countdown",     "icon" => "timer"], 
            ["menu" => "Gift",          "icon" => "gift"], 
            ["menu" => "RSVP",          "icon" => "chatbubble-ellipses"], 
            ["menu" => "Terima Kasih",  "icon" => "star"], 
            ["menu" => "Footer",        "icon" => "ellipsis-horizontal-circle"]
        ];
        $this->page0 = '<h2 id="opening-title" class="text-lg font-normal tracking-widest text-center uppercase text-slate-100 animation-title">The Wedding Of</h2>
                        <h3 id="opening-couple-name" class="text-4xl font-medium tracking-widest text-center uppercase text-slate-100">{{mempelai}}</h3>
                        <div id="opening-guest" class="pt-4 space-y-1 font-light text-center text-slate-100">
                            <p>Kepada Yth:</p>
                            <p>Bapak/Ibu/Saudara/i</p>
                            <p class="font-semibold">{{guest}}</p>
                        </div>
                        <div id="opening-button-open-invitation" class="p-4 text-center">
                            <button id="button-open-invitation" onclick="openInvitation()" class="px-4 py-2 text-sm text-center duration-300 ease-in-out rounded-full text-slate-800 bg-slate-200 hover:scale-105">Buka Undangan</button>
                        </div>';
        $this->page1 = '<h2 id="opening-title" class="text-lg font-normal tracking-widest text-center uppercase text-slate-100 animation-title">Dummy</h2>';

        for ($i = 0; $i <= 13; $i++) {
            switch ($i) {
                case 0:
                    $content = $this->page0;
                    break;
                
                default:
                    $content = $this->page1;
                    break;
            }
           
            // Ganti placeholder dengan nama tamu
            $content = str_replace('{{guest}}', $this->namaTamu, $content);
            $content = str_replace('{{mempelai}}', $this->namaMempelai, $content);
        
            $this->items[] = [
                "menu"      => $this->menus[$i]['menu'],
                "icon"      => $this->menus[$i]['icon'],
                "content"   => $content
            ];
        }
    }

    public function render() {
        return view('livewire.digital-invitation.invitation-viewer')->layout('components.layouts.invitation');
    }
}
