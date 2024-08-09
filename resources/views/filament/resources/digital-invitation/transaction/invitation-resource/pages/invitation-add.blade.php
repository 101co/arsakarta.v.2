<x-filament-panels::page>
  <x-filament-panels::form wire:submit="create">
    {{ $this->form }}

    <x-filament-panels::form.actions :actions="$this->getFormActions()" />
  </x-filament-panels::form>

  {{-- <x-filament::modal id="test-modal" :close-by-clicking-away="false" width="md">
    <x-slot name="heading">
      Choose Song
    </x-slot>

    @foreach ($this->getDataku() as $item)
    <div class="relative flex flex-col text-gray-700 bg-white shadow-md w-full rounded-xl bg-clip-border">
      <nav class="flex min-w-[240px] flex-col gap-1 p-1 font-sans text-base font-normal text-blue-gray-700">
        <div role="button" 
          class="flex items-center w-full p-3 gap-x-2 leading-tight transition-all rounded-lg outline-none text-start hover:bg-gray-200 hover:bg-opacity-80 hover:text-blue-gray-900 focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
          <div class="grid mr-4 place-items-center">
            <img alt="candice" src="{{ url('storage/'.$item->song_image) }}"
              class="relative inline-block h-12 w-12 !rounded-full  object-cover object-center" />
          </div>
          <audio hidden id="file-audio-{{ $item->id }}" src="{{ url('storage/'.$item->song_filename) }}"></audio>
          <div class="me-auto">
            <h6
              class="block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
              {{ $item->song_title }}
            </h6>
          </div>
          <div>
            <button class="button duration-100 ease-in-out active:scale-95 hover:scale-105"
              onclick="playMusic({{ $item->id }})"
              >
              <x-filament::icon-button id="play-audio-button-{{ $item->id }}" size="xl"
                icon="heroicon-o-play-circle" href="#" tag="a" label="Filament" />
              <x-filament::icon-button id="stop-audio-button-{{ $item->id }}" class="hidden animate-pulse" size="xl"
                icon="heroicon-o-stop-circle" href="#" tag="a" label="Filament" />
            </button>
            <button class="button duration-100 ease-in-out active:scale-95 hover:scale-110"
              wire:click="chooseSong({{ $item->id }})"
              >
              <x-filament::icon-button id="play-audio-button-{{ $item->id }}" size="xl"
                icon="heroicon-o-check-circle" href="#" tag="a" label="Filament" tooltip="Choose {{ $item->song_title }}"/>
            </button>
          </div>
        </div>
      </nav>
    </div>
    @endforeach
    <br>
  </x-filament::modal> --}}

  <script>
    function playMusic(id) 
      {
        // get current audio, play button, dan stop button
        var currentAudio = document.getElementById("file-audio-"+id);
        var currentPlayButton = document.getElementById('play-audio-button-'+id);
        var currentStopButton = document.getElementById('stop-audio-button-'+id);

        // cek apakah ada audio lain yang sedang diplay
        var othersAudio = document.querySelectorAll('[id*="file-audio-"]');
        for (var i=0; i<othersAudio.length; i++)
        {
          if(othersAudio[i].id != "file-audio-"+id && !othersAudio[i].paused) 
          {
            var otherAudion = document.getElementById(othersAudio[i].id);
            otherAudion.currentTime = 0;
            otherAudion.pause();
          }
        }

        // reset other play button
        var othersPlayButton = document.querySelectorAll('[id*="play-audio-button"]');
        for(var i=0;i<othersPlayButton.length;i++)
        {
          var otherPlayButton = document.getElementById(othersPlayButton[i].id);
          if(othersPlayButton[i].id != "play-audio-button-"+id)
          {
            otherPlayButton.classList.remove('hidden');
          }
        }

        // reset other stop button
        var othersStopButton = document.querySelectorAll('[id*="stop-audio-button"]');  
        for(var i=0;i<othersStopButton.length;i++)
        {
            var otherStopButton = document.getElementById(othersStopButton[i].id);
            if(othersStopButton[i].id != "stop-audio-button-"+id)
            {
              otherStopButton.classList.add('hidden');
            }
        }

        // play atau stop current audio
        // set icon untuk play / stop current button
        if (currentAudio.paused) 
        {
          currentPlayButton.classList.add('hidden');
          currentStopButton.classList.remove('hidden');
          return currentAudio.play();
        }
        else
        {
          currentPlayButton.classList.remove('hidden');
          currentStopButton.classList.add('hidden');
          currentAudio.currentTime = 0;
          return currentAudio.pause();
        }
      }
  </script>
</x-filament-panels::page>