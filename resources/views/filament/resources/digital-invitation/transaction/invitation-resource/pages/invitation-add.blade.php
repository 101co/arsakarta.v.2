<x-filament-panels::page>
  <x-filament-panels::form wire:submit="create">
    {{ $this->form }}

    <x-filament-panels::form.actions :actions="$this->getFormActions()"/>
  </x-filament-panels::form>
  <x-filament::modal id="test-modal" :close-by-clicking-away="false">
    <x-slot name="heading">
      Modal heading
    </x-slot>
    <h1>HELLO</h1>
    <x-filament::input.wrapper>
      <x-filament::input.select wire:model="status">
          <option value="draft">Draft</option>
          <option value="reviewing">Reviewing</option>
          <option value="published">Published</option>
      </x-filament::input.select>
    </x-filament::input.wrapper>
    <x-filament::loading-indicator class="h-5 w-5" />
    <x-filament::button wire:click="chooseTestModal">
      Choose
    </x-filament::button>
  </x-filament::modal>
</x-filament-panels::page>
