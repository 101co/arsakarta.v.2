<x-filament-panels::page>
  <x-filament-panels::form wire:submit="create">
    {{ $this->form }}

    <x-filament-panels::form.actions :actions="$this->getFormActions()" />
  </x-filament-panels::form>

  <x-filament::modal id="test-modal" :close-by-clicking-away="false">
    <x-slot name="heading">
      Choose Song
    </x-slot>

      <ul role="list" class="p-6 divide-y divide-slate-200">
          @foreach ($this->getDataku() as $item)
            <li class="flex py-4 first:pt-0 last:pb-0">
              <img class="h-10 w-10 rounded-full mr-2" src="{{ url('storage/'.$item->song_image) }}" alt="" />
              <div class="ml-5 overflow-hidden place-items-center w-full">
                  <p class="text-sm font-medium text-slate-900">{{ $item->song_title }}</p>
                  <audio hidden id="file-audio-{{ $item->id }}" src="{{ url('storage/'.$item->song_filename) }}"></audio>
              </div>
                <div>
                    <button class="duration-100 ease-in-out active:scale-95" onclick="playMusic({{ $item->id }})" >
                        <x-filament::icon-button id="play-audio-button-{{ $item->id }}" icon="heroicon-o-play-circle" href="#" tag="a" label="Filament"/>
                        <x-filament::icon-button id="stop-audio-button-{{ $item->id }}" class="hidden" icon="heroicon-o-stop-circle" href="#" tag="a" label="Filament"/>
                    </button>
                </div>
            </li>
          @endforeach
      </ul>
                            
      <div>
        <button class="rounded-full bg-blue-500 px-4 py-1 text-sm font-medium text-white duration-100 ease-in-out hover:bg-blue-700 active:scale-95" >
          Choose
        </button>
      </div>

    <x-filament::button wire:click="chooseTestModal">
      Choose
    </x-filament::button>
  </x-filament::modal>

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
