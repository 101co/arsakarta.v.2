<?php

namespace App\Livewire\DigitalInvitation;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\DigitalInvitation\Master\Theme;

class InvitationViewer extends Component {
    public $items = [];
    public $menus = [];

    public $viewName;
    public $namaTamu = "Bowo & Selly";
    public $namaMempelai = "Arsa & Nika";
    public $quote = '“Love recognises no barriers, it jumps hurdles, leaps fences, penetrates walls to arrive at its destination, full of hope.”';

    public $isButtonBasedView = true;

    public function mount() {
        // hardcode theme dengan id 5 sebagai demo
        $this->namaTamu = request()->query('guest') ? request()->query('guest'):'unknown';
        $theme = Theme::where('id', '=', 5)->first();
        $this->isButtonBasedView = true;

        foreach ($theme['layouts'] as $layout) {
            $this->items[] = [
                "menu"      => Str::title($layout),
                "icon"      => getButtonIconMenu($layout), // nanti ikon dibuatkan menu mapping saja
                "content"   => $this->getView($theme['theme_category'].'.'.$theme['theme_name'], $layout, [
                    'namaMempelai'  => $this->namaMempelai,
                    'namaTamu'      => $this->namaTamu,
                    'quote'         => $this->quote
                ])
            ];
        }
    }

    public function getView($themeName, $pageName, $params) {
        $defaultPath = 'livewire.digital-invitation.themes';
        return view($defaultPath.'.'.$themeName.'.'.$pageName, $params)->render();
    }

    public function render() {
        return view('livewire.digital-invitation.invitation-viewer')->layout('components.layouts.invitation');
    }
}
