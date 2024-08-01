<x-filament-panels::page>
  <x-filament-panels::form wire:submit="create">
    {{ $this->form }}

    <x-filament-panels::form.actions :actions="$this->getFormActions()" />
  </x-filament-panels::form>

  <x-filament::modal id="test-modal" :close-by-clicking-away="false">
    <x-slot name="heading">
      Choose Song
    </x-slot>

    <ul>
        @foreach ($this->getDataku() as $item)
          <li>
            <div class="mx-auto mb-3 flex max-w-sm items-center space-x-4 rounded-xl bg-white p-6 shadow-lg">
              <div class="size-px ">
                <img class="size-px rounded-full" src="{{ url('storage/'.$item->song_image) }}" alt="image" />
              </div>
              <div class="w-full">
                <div class="text-sm font-medium text-black">{{ $item->song_title }}</div>
                <audio hidden id="file-audio-{{ $item->id }}" src="{{ url('storage/'.$item->song_filename) }}"></audio>
              </div>
              <div>
                <button class="duration-100 ease-in-out active:scale-95" onclick="playMusic(1)" >
                    <x-filament::icon-button id="play-audio-button-{{ $item->id }}" icon="heroicon-o-play-circle" href="#" tag="a" label="Filament"/>
                    <x-filament::icon-button id="stop-audio-button-{{ $item->id }}" class="hidden" icon="heroicon-o-stop-circle" href="#" tag="a" label="Filament"/>
                        
<!--                   <svg id="play-audio-button-{{ $item->id }}" type="button" class="size-9 stroke-gray-500 hover:fill-slate-100 active:fill-slate-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.91 11.672a.375.375 0 0 1 0 .656l-5.603 3.113a.375.375 0 0 1-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112Z" />
                  </svg> 
                  <svg id="stop-audio-button-{{ $item->id }}" type="button" class="hidden animate-pulse size-9 stroke-gray-500 hover:fill-slate-100 active:fill-slate-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 9.563C9 9.252 9.252 9 9.563 9h4.874c.311 0 .563.252.563.563v4.874c0 .311-.252.563-.563.563H9.564A.562.562 0 0 1 9 14.437V9.564Z" />
                  </svg>                 -->
                </button>
              </div>
              <div>
                <button class="rounded-full bg-blue-500 px-4 py-1 text-sm font-medium text-white duration-100 ease-in-out hover:bg-blue-700 active:scale-95" >
                  Choose
                </button>
              </div>
            </div>
          </li>
        @endforeach
    </ul>
    {{-- url('storage/'.$item->song_filename) --}}
<!--     <div class="p-6 max-w-sm mx-auto bg-white rounded-xl shadow-lg flex items-center space-x-4">
      <div class="shrink-0">
        {{-- <img class="size-12 w-2" src="{{ url('storage/'.$item->song_image) }}" alt="ChitChat Logo"> --}}
      </div>
      <div>
        <div class="text-xl font-thin text-blue-600">ChitChat</div>
        <p class="text-slate-500">You have a new message!</p>
      </div>
    </div> -->

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
