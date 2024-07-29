<x-filament-panels::page>
  <x-filament-panels::form wire:submit="create">
    {{ $this->form }}

    <x-filament-panels::form.actions :actions="$this->getFormActions()"/>
  </x-filament-panels::form>
  <x-filament::modal id="test-modal" :close-by-clicking-away="false">
    <x-slot name="heading">
      Choose Song
    </x-slot>

    {{-- @foreach ($this->getDataku() as $item)
    <x-filament::button size="xs" color="gray" outlined icon="heroicon-o-musical-note" wire:click="chooseSong()">
      {{ $item->song_title }}
    </x-filament::button>
    @endforeach --}}

    <x-filament::button wire:click="chooseTestModal">
      Choose
    </x-filament::button>
  </x-filament::modal>
</x-filament-panels::page>
