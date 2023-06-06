<x-guest-layout>
  <x-slot name="slot">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          KONTAKT            
      </h2>
      <img class="rounded-lg py-2 w-full " src="img/home/Kontakt_gross.jpg" alt="">
      <div class="bg-slate-50 px-4 py-5 sm:rounded-lg sm:p-6">
        <div class="md:grid md:grid-cols-2 md:gap-6">
          <div class="md:col-span-1">
            {{-- <h3 class="text-lg font-medium leading-6 text-gray-900">Profile</h3>
            <p class="mt-1 text-sm text-gray-500">This information will be displayed publicly so be careful what you share.</p> --}}
        
            <div class="et_pb_text_inner"><strong>Ansprechpartner:</strong><p></p>
              <p class="pt-3">Christof Jaskula<br>
              Hans-Willy-Mertens Str. 2<br>
              50858 Köln
          </p>
              <p class="pt-3" >Tel.: +49 (0)2234 9444320</p>
              <p class="pt-3"><a href="mailto:info@e-neko.de">info@e-neko.de</a></p>
              <p class="pt-3">oder benutzen Sie einfach unser Kontaktformular!</p></div>
          </div>
          <div class="mt-5 md:mt-0 md:col-span-1">
            <livewire:guest.kontakt />            
          </div>
        </div>
      
        <div class="w-full font-semibold mt-5">
          <h2>hier finden Sie uns</h2>
          <div class="bg-slate-100 w-full h-96" id="map"></div>
      </div>


      <script type="text/javascript">
        function initMap() {
          const myLatLng = { lat: 50.9474143424995, lng: 6.838014968232122 };
          const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 11,
            center: myLatLng,
            mapTypeControl: false,                  
          });
  
          const contentString =
          '<div id="content">' +
            '<div id="bodyContent"></div>' +
            '<div class="flex items-center gap-2">' +
              '<img class="w-4" src="/img/logo-mini.png"> <p class="font-semibold align-middle" id="firstHeading" class="firstHeading">Eneko GmbH</p>' +           
            '</div>' +
            '<p class="mt-1">Hans-Willy-Mertens-Str. 2 </p>' +
            '<p class="mt-1">50858 Köln</p>' +
          '</div>';

          const infowindow = new google.maps.InfoWindow({
            content: contentString,
          });

          const marker = new google.maps.Marker({
            position: myLatLng,
            map,
            title: "Eneko",
          
          });


          infowindow.open({
              anchor: marker,
              map,
              shouldFocus: false,
            });

          marker.addListener("click", () => {
            infowindow.open({
              anchor: marker,
              map,
              shouldFocus: false,
            });
          });
          
        } 
        window.initMap = initMap;
      </script>

      <script type="text/javascript"
        src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap" >
      </script>

    </div>
  
  </div>
  </x-slot>
</x-guest-layout>