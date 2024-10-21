<x-filament-panels::page>
  <x-filament-panels::form wire:submit="create">
    {{ $this->form }}
    <x-filament-panels::form.actions :actions="$this->getFormActions()" />
  </x-filament-panels::form>

  <x-filament::modal id="modal-package" width="xl" sticky-header sticky-footer :close-button="true">
    {{-- <x-slot name="heading">
        <span class="text-xl font-light">Package</span>
    </x-slot> --}}

    <div x-data="{ tab: 'P001' }">
      <div class="flex items-center justify-center gap-x-4">
        <x-filament::tabs label="Content tabs">
          @foreach ($this->getPackageList() as $package)
            <x-filament::tabs.item @click="tab = '{{ $package->initial }}'" alpine-active="tab === '{{ $package->initial }}'">
              <span class="text-lg font-bold text-gray-800">{{ $package->name }}</span>
              <br>
              <span class="mt-4">IDR <span class="text-xs font-semibold">{{ $package->price }}</span></span>
            </x-filament::tabs.item>
          @endforeach
        </x-filament::tabs>
      </div>
  
      <div class="mt-4">
          @foreach ($this->getPackageList() as $package)
          <div x-show="tab === '{{  $package->initial }}'">
            <x-filament::section>
              <ul class="space-y-4 text-left text-gray-500 dark:text-gray-400">
                @foreach ($package->detail as $det)
                <li class="flex items-center gap-4 space-x-3 rtl:space-x-reverse">
                    <x-filament::icon icon="heroicon-o-check" class="w-5 h-5 text-gray-500 dark:text-gray-400"/>
                    <span class="text-gray-700">{{$det['description']}}</span>
                </li>
                @endforeach
              </ul>
            </x-filament::section>
          </div>
          @endforeach
  
          {{-- <div x-show="tab === 'tab2'">
            <x-filament::section>
              <ul class="space-y-4 text-left text-gray-500 dark:text-gray-400">
                <li class="flex items-center gap-4 space-x-3 rtl:space-x-reverse">
                    <x-filament::icon icon="heroicon-o-check" class="w-5 h-5 text-gray-500 dark:text-gray-400"/>
                    <span>Individual configuration</span>
                </li>
                <li class="flex items-center gap-4 space-x-3 rtl:space-x-reverse">
                    <x-filament::icon icon="heroicon-o-x-mark" class="w-5 h-5 text-gray-500 dark:text-gray-400"/>
                    <span>No setup, or hidden fees</span>
                </li>
                <li class="flex items-center gap-4 space-x-3 rtl:space-x-reverse">
                    <x-filament::icon icon="heroicon-o-x-mark" class="w-5 h-5 text-gray-500 dark:text-gray-400"/>
                    <span>No setup, or hidden fees</span>
                </li>
                <li class="flex items-center gap-4 space-x-3 rtl:space-x-reverse">
                    <x-filament::icon icon="heroicon-o-x-mark" class="w-5 h-5 text-gray-500 dark:text-gray-400"/>
                    <span>No setup, or hidden fees</span>
                </li>
                <li class="flex items-center gap-4 space-x-3 rtl:space-x-reverse">
                    <x-filament::icon icon="heroicon-o-x-mark" class="w-5 h-5 text-gray-500 dark:text-gray-400"/>
                    <span>No setup, or hidden fees</span>
                </li>
                <li class="flex items-center gap-4 space-x-3 rtl:space-x-reverse">
                    <x-filament::icon icon="heroicon-o-x-mark" class="w-5 h-5 text-gray-500 dark:text-gray-400"/>
                    <span>No setup, or hidden fees</span>
                </li>
                <li class="flex items-center gap-4 space-x-3 rtl:space-x-reverse">
                    <x-filament::icon icon="heroicon-o-x-mark" class="w-5 h-5 text-gray-500 dark:text-gray-400"/>
                    <span>No setup, or hidden fees</span>
                </li>
                <li class="flex items-center gap-4 space-x-3 rtl:space-x-reverse">
                    <x-filament::icon icon="heroicon-o-x-mark" class="w-5 h-5 text-gray-500 dark:text-gray-400"/>
                    <span>No setup, or hidden fees</span>
                </li>
                <li class="flex items-center gap-4 space-x-3 rtl:space-x-reverse">
                    <x-filament::icon icon="heroicon-o-x-mark" class="w-5 h-5 text-gray-500 dark:text-gray-400"/>
                    <span>No setup, or hidden fees</span>
                </li>
                <li class="flex items-center gap-4 space-x-3 rtl:space-x-reverse">
                    <x-filament::icon icon="heroicon-o-x-mark" class="w-5 h-5 text-gray-500 dark:text-gray-400"/>
                    <span>No setup, or hidden fees</span>
                </li>
                <li class="flex items-center gap-4 space-x-3 rtl:space-x-reverse">
                    <x-filament::icon icon="heroicon-o-x-mark" class="w-5 h-5 text-gray-500 dark:text-gray-400"/>
                    <span>No setup, or hidden fees</span>
                </li>
                <li class="flex items-center gap-4 space-x-3 rtl:space-x-reverse">
                    <x-filament::icon icon="heroicon-o-x-mark" class="w-5 h-5 text-gray-500 dark:text-gray-400"/>
                    <span>No setup, or hidden fees</span>
                </li>
                <li class="flex items-center gap-4 space-x-3 rtl:space-x-reverse">
                    <x-filament::icon icon="heroicon-o-x-mark" class="w-5 h-5 text-gray-500 dark:text-gray-400"/>
                    <span>No setup, or hidden fees</span>
                </li>
              </ul>
            </x-filament::section>
          </div>
  
          <div x-show="tab === 'tab3'">
            <x-filament::section>
              <ul class="space-y-4 text-left text-gray-500 dark:text-gray-400">
                <li class="flex items-center gap-4 space-x-3 rtl:space-x-reverse">
                    <x-filament::icon icon="heroicon-o-check" class="w-5 h-5 text-gray-500 dark:text-gray-400"/>
                    <span>Diamond</span>
                </li>
                <li class="flex items-center gap-4 space-x-3 rtl:space-x-reverse">
                    <x-filament::icon icon="heroicon-o-x-mark" class="w-5 h-5 text-gray-500 dark:text-gray-400"/>
                    <span>No setup, or hidden fees</span>
                </li>
                <li class="flex items-center gap-4 space-x-3 rtl:space-x-reverse">
                    <x-filament::icon icon="heroicon-o-x-mark" class="w-5 h-5 text-gray-500 dark:text-gray-400"/>
                    <span>No setup, or hidden fees</span>
                </li>
                <li class="flex items-center gap-4 space-x-3 rtl:space-x-reverse">
                    <x-filament::icon icon="heroicon-o-x-mark" class="w-5 h-5 text-gray-500 dark:text-gray-400"/>
                    <span>No setup, or hidden fees</span>
                </li>
                <li class="flex items-center gap-4 space-x-3 rtl:space-x-reverse">
                    <x-filament::icon icon="heroicon-o-x-mark" class="w-5 h-5 text-gray-500 dark:text-gray-400"/>
                    <span>No setup, or hidden fees</span>
                </li>
                <li class="flex items-center gap-4 space-x-3 rtl:space-x-reverse">
                    <x-filament::icon icon="heroicon-o-x-mark" class="w-5 h-5 text-gray-500 dark:text-gray-400"/>
                    <span>No setup, or hidden fees</span>
                </li>
                <li class="flex items-center gap-4 space-x-3 rtl:space-x-reverse">
                    <x-filament::icon icon="heroicon-o-x-mark" class="w-5 h-5 text-gray-500 dark:text-gray-400"/>
                    <span>No setup, or hidden fees</span>
                </li>
                <li class="flex items-center gap-4 space-x-3 rtl:space-x-reverse">
                    <x-filament::icon icon="heroicon-o-x-mark" class="w-5 h-5 text-gray-500 dark:text-gray-400"/>
                    <span>No setup, or hidden fees</span>
                </li>
                <li class="flex items-center gap-4 space-x-3 rtl:space-x-reverse">
                    <x-filament::icon icon="heroicon-o-x-mark" class="w-5 h-5 text-gray-500 dark:text-gray-400"/>
                    <span>No setup, or hidden fees</span>
                </li>
                <li class="flex items-center gap-4 space-x-3 rtl:space-x-reverse">
                    <x-filament::icon icon="heroicon-o-x-mark" class="w-5 h-5 text-gray-500 dark:text-gray-400"/>
                    <span>No setup, or hidden fees</span>
                </li>
                <li class="flex items-center gap-4 space-x-3 rtl:space-x-reverse">
                    <x-filament::icon icon="heroicon-o-x-mark" class="w-5 h-5 text-gray-500 dark:text-gray-400"/>
                    <span>No setup, or hidden fees</span>
                </li>
                <li class="flex items-center gap-4 space-x-3 rtl:space-x-reverse">
                    <x-filament::icon icon="heroicon-o-x-mark" class="w-5 h-5 text-gray-500 dark:text-gray-400"/>
                    <span>No setup, or hidden fees</span>
                </li>
              </ul>
            </x-filament::section>
          </div> --}}
      </div>
      <div class="w-full mt-8">
          <div class="text-sm text-gray-500 text-start">
            <span>Notes:</span>
            <ul class="space-y-4 text-left">
              <li class="flex items-center space-x-1 rtl:space-x-reverse">
                <x-filament::icon icon="heroicon-o-x-mark" class="w-4 h-4"/>
                <span>Packages cannot be changed after payment</span>
              </li>
            </ul>
          </div>
      </div>
    </div>
  </x-filament::modal>

  <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-s9t2Tqf5BY_zW7qZ"></script>
  <script>
    function playMusic(id) {
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

    function snapPay() {
      console.log('snapPay');
    }
    
    window.addEventListener("snap-pay", (event) => {
      console.log('snapPay');
      let data = event.detail;
      console.log(data);

      window.snap.pay(data.token, {
          onSuccess: function(result) {
              /* You may add your own implementation here */
              // alert("payment success!"); console.log(result);
              // $('#all-package-modal').modal('hide');
              // Swal.fire({
              //     title: 'Payment',
              //     text: 'Pembayaran berhasil.',
              //     icon: 'success',
              //     timer: 4000,
              //     toast: true
              // });
              Livewire.dispatch('payment-success', {order_id: result.order_id});
          },
          onPending: function(result) {
              /* You may add your own implementation here */
              // alert("wating your payment!"); console.log(result);
              // Swal.fire({
              //     title: 'Payment',
              //     text: 'Pembayaran dipending.',
              //     icon: 'warning',
              //     timer: 3000,
              //     toast: true
              // });
              Livewire.dispatch('payment-close');
          },
          onError: function(result) {
              /* You may add your own implementation here */
              // alert("payment failed!"); console.log(result);
              // Swal.fire({
              //     title: 'Payment',
              //     text: 'Pembayaran gagal.',
              //     icon: 'error',
              //     timer: 3000,
              //     toast: true
              // });
              Livewire.dispatch('payment-close');
          },
          onClose: function() {
              /* You may add your own implementation here */
              // Swal.fire({
              //     title: 'Payment',
              //     text: 'Pembayaran dibatalkan.',
              //     icon: 'warning',
              //     timer: 3000,
              //     toast: true
              // });
              Livewire.dispatch('payment-closed');
          }
      });
    });
  </script>
</x-filament-panels::page>