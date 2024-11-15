<?php

use Illuminate\Support\Str;

if (! function_exists('getBlockBuilder')) {
    function getBlockBuilder($layoutName, $eventCategory) {
        // wedding
        if (Str::is('wedding', Str::lower($eventCategory))) {
            return getBlockBuilderForWedding($layoutName);
        }
    }
}

if (! function_exists('getBlockBuilderForWedding')) {
    
    function getBlockBuilderForWedding($layoutName) {
        // cover
        if (Str::is($layoutName, 'cover')) {
            return [
                'type' => 'cover',
                'label' => 'Cover',
                'fields' => [
                    ['name' => 'cover_title', 'label' => 'Judul', 'type' => 'text', 'default' => 'The Wedding Of', 'required' => true],
                    ['name' => 'cover_couple_name', 'label' => 'Nama Mempelai', 'type' => 'text', 'default' => '', 'required' => true],
                    ['name' => 'cover_button_title', 'label' => 'Judul Tombol', 'type' => 'text', 'default' => 'Buka Undangan', 'required' => true]
                ]
            ];
        }
        
        // salam
        if (Str::is($layoutName, 'salam')) {
            return [
                'type' => 'salam',
                'label' => 'Salam',
                'fields' => [
                    ['name' => 'salam_title', 'label' => 'Judul', 'type' => 'text', 'default' => 'Salam', 'required' => true],
                ]
            ];
        }
        
        // protokol
        if (Str::is($layoutName, 'protokol')) {
            return [
                'type' => 'protokol',
                'label' => 'Protokol',
                'fields' => [
                    ['name' => 'protokol_title', 'label' => 'Judul', 'type' => 'text', 'default' => 'Protokol', 'required' => true],
                ]
            ];
        }
        
        // mempelai
        if (Str::is($layoutName, 'mempelai')) {
            return [
                'type' => 'mempelai',
                'label' => 'Mempelai',
                'fields' => [
                    ['name' => 'mempelai_title', 'label' => 'Judul', 'type' => 'text', 'default' => 'Bride & Groom', 'required' => true],
                    ['name' => 'mempelai_caption', 'label' => 'Caption', 'type' => 'text', 'default' => '', 'required' => false],
                    ['name' => 'mempelai_nama_pria', 'label' => 'Mempelai Pria', 'type' => 'text', 'default' => '', 'required' => true],
                    ['name' => 'mempelai_pria_orangtua', 'label' => 'Orang Tua Mempelai Pria', 'type' => 'text', 'default' => '', 'required' => true],
                    ['name' => 'mempelai_nama_wanita', 'label' => 'Mempelai Wanita', 'type' => 'text', 'default' => '', 'required' => true],
                    ['name' => 'mempelai_wanita_orangtua', 'label' => 'Orang Tua Mempelai Wanita', 'type' => 'text', 'default' => '', 'required' => true],
                ]
            ];
        }
        
        // bride
        if (Str::is($layoutName, 'bride')) {
            return [
                'type' => 'bride',
                'label' => 'Bride',
                'fields' => [
                    ['name' => 'bride_title', 'label' => 'Judul', 'type' => 'text', 'default' => 'Bride', 'required' => true],
                    ['name' => 'bride_photo', 'label' => 'Photo', 'type' => 'text', 'default' => '', 'required' => false],
                    ['name' => 'bride_name', 'label' => 'Nama', 'type' => 'text', 'default' => '', 'required' => true],
                    ['name' => 'bride_caption', 'label' => 'Nama', 'type' => 'text', 'default' => '', 'required' => false],
                    ['name' => 'bride_instagram', 'label' => 'Instagram', 'type' => 'text', 'default' => '', 'required' => false],
                ]
            ];
        }
        
        // groom
        if (Str::is($layoutName, 'groom')) {
            return [
                'type' => 'groom',
                'label' => 'Groom',
                'fields' => [
                    ['name' => 'groom_title', 'label' => 'Judul', 'type' => 'text', 'default' => 'Groom', 'required' => true],
                    ['name' => 'groom_photo', 'label' => 'Photo', 'type' => 'text', 'default' => '', 'required' => false],
                    ['name' => 'groom_name', 'label' => 'Nama', 'type' => 'text', 'default' => '', 'required' => true],
                    ['name' => 'groom_caption', 'label' => 'Nama', 'type' => 'text', 'default' => '', 'required' => false],
                    ['name' => 'groom_instagram', 'label' => 'Instagram', 'type' => 'text', 'default' => '', 'required' => false],
                ]
            ];
        }
        
        // acara
        if (Str::is($layoutName, 'acara')) {
            return [
                'type' => 'acara',
                'label' => 'Acara',
                'fields' => [
                    ['name' => 'acara_title', 'label' => 'Judul', 'type' => 'text', 'default' => 'Acara', 'required' => true],
                ]
            ];
        }
        
        // galeri
        if (Str::is($layoutName, 'galeri')) {
            return [
                'type' => 'galeri',
                'label' => 'Galeri',
                'fields' => [
                    ['name' => 'galeri_title', 'label' => 'Judul', 'type' => 'text', 'default' => 'Our Galery', 'required' => true],
                ]
            ];
        }
        
        // story
        if (Str::is($layoutName, 'story')) {
            return [
                'type' => 'story',
                'label' => 'Story',
                'fields' => [
                    ['name' => 'story_title', 'label' => 'Judul', 'type' => 'text', 'default' => 'Our Story', 'required' => true],
                ]
            ];
        }
        
        // countdown
        if (Str::is($layoutName, 'countdown')) {
            return [
                'type' => 'countdown',
                'label' => 'Countdown',
                'fields' => [
                    ['name' => 'countdown_title', 'label' => 'Judul', 'type' => 'text', 'default' => 'Countdown', 'required' => true],
                ]
            ];
        }
        
        // hadiah
        if (Str::is($layoutName, 'hadiah')) {
            return [
                'type' => 'hadiah',
                'label' => 'Hadiah',
                'fields' => [
                    ['name' => 'hadiah_title', 'label' => 'Judul', 'type' => 'text', 'default' => 'Hadiah', 'required' => true],
                ]
            ];
        }
        
        // rsvp
        if (Str::is($layoutName, 'rsvp')) {
            return [
                'type' => 'rsvp',
                'label' => 'RSVP',
                'fields' => [
                    ['name' => 'rsvp_title', 'label' => 'Judul', 'type' => 'text', 'default' => 'RSVP', 'required' => true],
                ]
            ];
        }
        
        // footer
        if (Str::is($layoutName, 'footer')) {
            return [
                'type' => 'footer',
                'label' => 'Footer',
                'fields' => [
                    ['name' => 'footer_title', 'label' => 'Judul', 'type' => 'text', 'default' => 'Footer', 'required' => true],
                ]
            ];
        }

        // quote
        if (Str::is($layoutName, 'quote')) {
            return [
                'type' => 'quote',
                'label' => 'Quote',
                'fields' => [
                    ['name' => 'quote_content', 'label' => 'Quote', 'type' => 'textarea', 'default' => '', 'required' => true],
                ]
            ];
        }
    }
}