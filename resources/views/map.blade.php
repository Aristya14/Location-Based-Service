@extends('layouts.nav')

@section('content')
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel - Leaflet</title>

    <link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />

    {{-- Pada view map.blade ini kita menambahkan beberapa cdn diantaranya
    bootstrap, leaflet css dan js, leaflet control search css dan js --}}
    
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin="" />

    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin="">
    </script>

     {{-- cdn leaflet search --}}
     <link rel="stylesheet" href="https://labs.easyblog.it/maps/leaflet-search/src/leaflet-search.css">
     <script src="https://labs.easyblog.it/maps/leaflet-search/src/leaflet-search.js"></script>
    

    <style>
        html,
        body {
            height: 95%;
            margin: 0;
        }
        .leaflet-container {
            height: 400px;
            width: 600px;
            max-width: 100%;
            max-height: 100%;
        }
    </style>

    <style>
        body {
            padding: 0;
            margin: 0;
        }
        #map {
            height: 100%;
            width: 100vw;
        }
    </style>
</head>

<body>
    <h3 style="font-family: Lucida Handwriting; margin:10px 0 10px 0; text-align:center">
        My Spaces</h3>
    <div id="map"></div>
    <script>
       
        var mbAttr = 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            mbUrl =
            'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';
        var satellite = L.tileLayer(mbUrl, {
                id: 'mapbox/satellite-v9',
                tileSize: 512,
                zoomOffset: -1,
                attribution: mbAttr
            }),
            dark = L.tileLayer(mbUrl, {
                id: 'mapbox/dark-v10',
                tileSize: 512,
                zoomOffset: -1,
                attribution: mbAttr
            }),
            streets = L.tileLayer(mbUrl, {
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                attribution: mbAttr
            });
        var map = L.map('map', {
                       
            center: [{{ $centrePoint->location }}],
            zoom: 5,
            layers: [streets]
        });
        var baseLayers = {
            "Grayscale": dark,
            "Satellite": satellite,
            "Streets": streets
        };
        var overlays = {
            "Streets": streets,
            "Grayscale": dark,
            "Satellite": satellite,
        };
        // Menampilkan popup data ketika marker di klik 
        @foreach ($spaces as $item)
            L.marker([{{ $item->location }}])
                .bindPopup(
                    "<div class='my-2'><img src='{{ asset('storage/uploads/' . $item->image) }}' class='img-fluid' width='700px'></div>" +
                    "<div class='my-2'><strong>Nama Space:</strong> <br>{{ $item->name }}</div>" + 
                    "<div><a href='{{ route('map.show', $item->slug) }}' class='btn btn-outline-info btn-sm'>Detail Space</a></div>" +
                    "<div class='my-2'></div>"
                ).addTo(map);
        @endforeach
    
        var datas = [    
        @foreach ($spaces as $key => $value) 
            {"loc":[{{$value->location }}], "title": '{!! $value->name !!}'},
        @endforeach            
        ];
        // pada koding ini kita menambahkan control pencarian data        
        var markersLayer = new L.LayerGroup();
        map.addLayer(markersLayer);
        var controlSearch = new L.Control.Search({
            position:'topleft',
            layer: markersLayer,
            initial: false,
            zoom: 17,
            markerLocation: true
        })
    
    //menambahkan variabel controlsearch pada addControl
       map.addControl( controlSearch );
        // looping variabel datas utuk menampilkan data space ketika melakukan pencarian data
        for(i in datas) {
          
            var title = datas[i].title,	
                loc = datas[i].loc,		
                marker = new L.Marker(new L.latLng(loc), {title: title} );
            markersLayer.addLayer(marker);
            // melakukan looping data untuk memunculkan popup dari space yang dipilih
            @foreach ($spaces as $item)
            L.marker([{{ $item->location }}]
                )
                .bindPopup(
                    "<div class='my-2'><img src='{{ asset('storage/uploads/' . $item->image) }}' class='img-fluid' width='700px'></div>" +
                    "<div class='my-2'><strong>Nama Spot:</strong> <br>{{ $item->name }}</div>" +
                    "<a href='{{ route('map.show', $item->slug) }}' class='btn btn-outline-info btn-sm'>Detail Spot</a></div>" +
                    "<div class='my-2'></div>"
                ).addTo(map);
            @endforeach
        }
        L.control.layers(baseLayers, overlays).addTo(map);
    </script>
</body>
@endsection

@push('javascript')
    {{-- load cdn js leaflet --}}
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""></script>
    <script>
        // Menambah attribut pada leaflet
        var mbAttr = 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            mbUrl =
            'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';
        // membuat beberapa layer untuk tampilan map diantaranya satelit, dark mode, street
            var satellite = L.tileLayer(mbUrl, {
                id: 'mapbox/satellite-v9',
                tileSize: 512,
                zoomOffset: -1,
                attribution: mbAttr
            }),
            dark = L.tileLayer(mbUrl, {
                id: 'mapbox/dark-v10',
                tileSize: 512,
                zoomOffset: -1,
                attribution: mbAttr
            }),
            streets = L.tileLayer(mbUrl, {
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                attribution: mbAttr
            });
        // Membuat var map untuk instance object map ke dalam tag div yang mempunyai id map
        // menambahkan titik koordinat latitude dan longitude peta indonesia kedalam opsi center
        // mengatur zoom map dan mengatur layer yang akan digunakan  
        var map = L.map('map', {
            center: [-0.789275,113.921327],
            zoom: 5,
            layers: [streets]
        });
        var baseLayers = {
            //"Grayscale": grayscale,
            "Streets": streets,
            "Satellite" : satellite
        };
        var overlays = {
            "Streets": streets,
            "Satellite": satellite,
        };
        //Menambahkan beberapa layer ke dalam peta/map
        L.control.layers(baseLayers, overlays).addTo(map);
        // set current location / lokasi sekarang dengan koordinat peta indonesia
        var curLocation = [-0.789275,113.921327];
        map.attributionControl.setPrefix(false);
        // set marker map agar bisa di geser
        var marker = new L.marker(curLocation, {
            draggable: 'true',
        });
        map.addLayer(marker);
        // ketika marker di geser kita akan mengambil nilai latitude dan longitude
        // kemudian memasukkan nilai tersebut ke dalam properti input text dengan name-nya location
        marker.on('dragend', function(event) {
            var location = marker.getLatLng();
            marker.setLatLng(location, {
                draggable: 'true',
            }).bindPopup(location).update();
            $('#location').val(location.lat + "," + location.lng).keyup()
        });
        // untuk fungsi di bawah akan mengambil nilai latitude dan longitudenya
        // dengan cara klik lokasi pada map dan secara otomatis marker juga akan ikut bergeser dan nilai
        // latitude dan longitudenya akan muncul pada input text location
        var loc = document.querySelector("[name=location]");
        map.on("click", function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;
            if (!marker) {
                marker = L.marker(e.latlng).addTo(map);
            } else {
                marker.setLatLng(e.latlng);
            }
            loc.value = lat + "," + lng;
        });
    </script>
@endpush

