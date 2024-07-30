<x-filament-panels::page>
  <x-filament-panels::form wire:submit="create">
    {{ $this->form }}

    <x-filament-panels::form.actions :actions="$this->getFormActions()" />
  </x-filament-panels::form>

  <x-filament::modal id="test-modal" :close-by-clicking-away="false">
    <x-slot name="heading">
      Choose Song
    </x-slot>

    @foreach ($this->getDataku() as $item)
    {{-- url('storage/'.$item->song_filename) --}}
    <div class="p-6 max-w-sm mx-auto bg-white rounded-xl shadow-lg flex items-center space-x-4">
      <div class="shrink-0">
        {{-- <img class="size-12 w-2" src="{{ url('storage/'.$item->song_image) }}" alt="ChitChat Logo"> --}}
      </div>
      <div>
        <div class="text-xl font-thin text-blue-600">ChitChat</div>
        <p class="text-slate-500">You have a new message!</p>
      </div>
    </div>
    @endforeach

    <x-filament::button wire:click="chooseTestModal">
      Choose
    </x-filament::button>
  </x-filament::modal>
</x-filament-panels::page>