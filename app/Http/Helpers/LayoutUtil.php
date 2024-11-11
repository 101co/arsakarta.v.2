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