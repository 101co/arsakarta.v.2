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
    public $page2;

    public function mount() {
        $this->namaTamu = request()->query('guest') ? request()->query('guest'):'unknown';
        $this->isButtonBasedView = true;
        $this->menus = [
            ["menu" => "Opening",       "icon" => "home-sharp"], 
            ["menu" => "Quote",         "icon" => "sparkles"], 
            ["menu" => "Mempelai",      "icon" => "heart"], 
            ["menu" => "Acara",         "icon" => "diamond"], 
            ["menu" => "Galeri",        "icon" => "images"], 
            ["menu" => "Love Story",    "icon" => "heart-circle"], 
            ["menu" => "Countdown",     "icon" => "timer"], 
            ["menu" => "RSVP",          "icon" => "chatbubble-ellipses"], 
            ["menu" => "Gift",          "icon" => "gift"], 
            ["menu" => "Thanks",        "icon" => "star"], 
            // ["menu" => "Salam",         "icon" => "chatbubbles"], 
            // ["menu" => "Protokol",      "icon" => "shield"], 
            // ["menu" => "Video",         "icon" => "videocam"], 
            // ["menu" => "Footer",        "icon" => "ellipsis-horizontal-circle"]
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
        $this->page1 = '<h2 id="quote-content" class="px-10 text-lg font-normal tracking-widest text-center uppercase text-slate-100 animation-title">“Love recognises no barriers, it jumps hurdles, leaps fences, penetrates walls to arrive at its destination, full of hope.”</h2>';
        $this->page2 = '
                        <h2 id="mempelai-title" class="text-lg font-normal tracking-widest text-center uppercase text-slate-100 animation-title">Mempelai</h2>
                        <h3 id="mempelai-sub-title" class="px-10 text-sm font-light tracking-widest text-center text-slate-100">Tuhan membuat segala sesuatu indah pada waktu-Nya Indah ketika Ia mempertemukan kami Indah ketika Ia menumbuhkan kasih di antara kami. Dan indah ketika Ia mempersatukan kami dalam sebuah ikatan Pernikahan Kudus</h3>
                        <div class="flex flex-col items-center justify-center w-full">
                            <span id="mempelai-pria" class="px-10 text-2xl font-semibold tracking-widest text-center text-slate-100">Bima Arya Putra</span>
                            <span id="mempelai-pria-sub" class="px-10 text-xs font-light tracking-widest text-center text-slate-100">Putra dari Bapak Widjaya dan Ibu Sari Atmadja</span>
                        </div>
                        <h3 id="mempelai-sub-title2" class="px-10 text-sm font-light tracking-widest text-center text-slate-100">dengan</h3>
                        <div class="flex flex-col items-center justify-center w-full">
                            <span id="mempelai-wanita" class="px-10 text-2xl font-semibold tracking-widest text-center text-slate-100">Nadia Setuari</span>
                            <span id="mempelai-wanita-sub" class="px-10 text-xs font-light tracking-widest text-center text-slate-100">Putri dari Bapak Jombang Ariadi dan Ibu Nisa Indah</span>
                        </div>
                        ';

        for ($i = 0; $i <= 9; $i++) {
            switch ($i) {
                case 0:
                    $content = $this->page0;
                    break;
                case 1:
                    $content = $this->page1;
                    break;
                case 2:
                    $content = $this->page2;
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
