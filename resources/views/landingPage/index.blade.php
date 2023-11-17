<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      /* gmp-map {
        height: 50%;
      } */

      /* Optional: Makes the sample page fill the window. */
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
</head>
<body>
    landing page
    <div class="card w-50 p-3">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
  </div>
  <div class="ratio ratio-1x1">
    @if ($sekolah != null)
    <gmp-map id="google-maps" center="{{ $sekolah->latitude }},{{ $sekolah->longitude }}" zoom="18" map-id="MAP_ID">
          {{-- position pertama adalah latitude dan position kedua adalah longitude --}}
        <gmp-advanced-marker position="{{ $sekolah->latitude }},{{ $sekolah->longitude }}" title="{{ $sekolah->name }}"></gmp-advanced-marker>
    </gmp-map>
    @else
    <h1>Data maps kosong</h1>
    @endif
  </div>
</div>

    <script>
        function initMap() {
      console.log('Maps JavaScript API loaded.');

      const advancedMarkers = document.querySelectorAll("#google-maps gmp-advanced-marker");
      for (const advancedMarker of advancedMarkers) {
        customElements.whenDefined(advancedMarker.localName).then(async () => {
          advancedMarker.addEventListener('gmp-click', async () => {
            const {InfoWindow} = await google.maps.importLibrary("maps");
            const infoWindow = new InfoWindow({
              content: advancedMarker.title
            });
            infoWindow.open({
              anchor: advancedMarker
            });
          });
        });
      }
    }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script async src="https://maps.googleapis.com/maps/api/js?key={{ env('API_KEY_MAPS') }}&callback=initMap&libraries=maps,marker&v=beta"></script>
</body>
</html>
