<?php

namespace App\Livewire\DigitalInvitation;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\DigitalInvitation\Master\Theme;
use App\Models\DigitalInvitation\Transaction\Invitation;

class InvitationViewer extends Component {
    public $items = [];
    public $menus = [];

    public $viewName;
    public $namaTamu = "Bowo & Selly";
    public $namaMempelai = "Arsa & Nika";
    public $quote = '“Love recognises no barriers, it jumps hurdles, leaps fences, penetrates walls to arrive at its destination, full of hope.”';

    public $isButtonBasedView = true;

    public function mount() {
        $invitation = Invitation::withoutGlobalScopes()->where('slug', '=', request()->segment('1'))->firstOrFail();

        if (!$invitation)
            abort(404);

        // hardcode theme dengan id 5 sebagai demo
        $this->namaTamu = request()->query('guest') ? request()->query('guest'):'unknown';
        $theme = Theme::where('id', '=', $invitation->theme_id)->first();
        $this->isButtonBasedView = true;

        foreach ($invitation['layouts'] as $layout) {
            // dd($layout['data']);
            $this->items[] = [
                "menu"      => Str::is($layout['type'], 'rsvp') ? Str::upper($layout['type']) : Str::title($layout['type']),
                "icon"      => getButtonIconMenu($layout['type']), // nanti ikon dibuatkan menu mapping saja
                "content"   => $this->getView($theme['theme_category'].'.'.$theme['theme_name'], $layout['type'], $layout['data'])
            ];
        }

        // foreach ($theme['layouts'] as $layout) {
        //     $this->items[] = [
        //         "menu"      => Str::is($layout, 'rsvp') ? Str::upper($layout) : Str::title($layout),
        //         "icon"      => getButtonIconMenu($layout), // nanti ikon dibuatkan menu mapping saja
        //         "content"   => $this->getView($theme['theme_category'].'.'.$theme['theme_name'], $layout, [
        //             'namaMempelai'  => $this->namaMempelai,
        //             'namaTamu'      => $this->namaTamu,
        //             'quote'         => $this->quote
        //         ])
        //     ];
        // }
    }

    public function getView($themeName, $pageName, $params) {
        $data = [];
        switch (strtolower($pageName)) {
            case 'cover':
                $data = [
                    'coverTitle'        => $params['cover_title'],
                    'coverCoupleName'   => $params['cover_couple_name'],
                    'coverGuestName'    => $this->namaTamu,
                    'coverButtonTitle'  => $params['cover_button_title'],
                ];
                break;
            case 'mempelai':
                $data = [
                    'mempelaiTitle'             => $params['mempelai_title'],
                    'mempelaiCaption'           => $params['mempelai_caption'],
                    'mempelaiNamaPria'          => $params['mempelai_nama_pria'],
                    'mempelaiNamaWanita'        => $params['mempelai_nama_wanita'],
                    'mempelaiPriaOrangtua'      => $params['mempelai_pria_orangtua'],
                    'mempelaiWanitaOrangtua'    => $params['mempelai_wanita_orangtua'],
                ];
                break;
            case 'bride':
                $data = [
                    'brideTitle'             => $params['bride_title'],
                ];
                break;
            case 'groom':
                $data = [
                    'groomTitle'             => $params['groom_title'],
                ];
                break;
            case 'acara':
                $data = [
                    'acaraTitle'             => $params['acara_title'],
                ];
                break;
            case 'galeri':
                $data = [
                    'galeriTitle'             => $params['galeri_title'],
                ];
                break;
            case 'story':
                $data = [
                    'storyTitle'             => $params['story_title'],
                ];
                break;
            case 'countdown':
                $data = [
                    'countdownTitle'             => $params['countdown_title'],
                ];
                break;
            case 'hadiah':
                $data = [
                    'hadiahTitle'             => $params['hadiah_title'],
                ];
                break;
            case 'rsvp':
                $data = [
                    'rsvpTitle'             => $params['rsvp_title'],
                ];
                break;
            case 'footer':
                $data = [
                    'footerTitle'             => $params['footer_title'],
                ];
                break;
            default:
                $data = [

                ];
              break;
        }

        $defaultPath = 'livewire.digital-invitation.themes';
        return view($defaultPath.'.'.$themeName.'.'.$pageName, $data)->render();
    }

    public function render() {
        return view('livewire.digital-invitation.invitation-viewer')->layout('components.layouts.invitation');
    }
}
