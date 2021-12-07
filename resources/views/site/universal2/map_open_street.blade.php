<link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
      integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
      crossorigin=""/>
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css' rel='stylesheet' />

<link rel="stylesheet" href="{{ mix('universal2/MarkerCluster.css') }}">
<link rel="stylesheet" href="{{ mix('universal2/MarkerCluster.Default.css') }}">


<div class="contact-page__map js-open-street-map js-contacts-tab-content-1" data-map-state="{{ $dictionary['contacts_open_street_map_state'] }}"
     data-url-template="{!! route('request.get_office_list') . '?bbox=%b' !!}"
></div>


<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
        integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
        crossorigin=""></script>
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>

<script src='{{ mix('universal2/leaflet.markercluster.js') }}'></script>
