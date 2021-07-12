<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Branch Detail</title>
</head>

<body>
    @extends('templates.tpl_default')
    @section('branch-detail')
        <h2 class="text-uppercase m-0 mt-3 font-weight-bold text-info">Contact {{ $branch['name'] }}</h2>
        <hr>
        <div class="row">
            <img src="../images/{{ $branch['logo'] }}" style="width: 100%; height: 450px; object-fit:cover" alt="">
        </div>
        <div class="row product_data">
            <div class="card border-0 w-100">
                <div class="card-header header-bg">
                    <h4 class="m-0">{{ $branch['name'] }} Branch</h4>
                </div>
                <div class="card-body">
                    <p class="card-text"><span class="font-weight-bold text-info">Address: </span>{{ $branch['address'] }}
                    </p>
                    <p class="card-text"><span class="font-weight-bold text-info">Phone: </span>{{ $branch['phone'] }}</p>
                </div>
                <div class="card-footer border-0 header-bg">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                aria-controls="home" aria-selected="true">Products</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                aria-controls="profile" aria-selected="false">Find Us</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="card-body">
                                <div class="row">
                                    <div class="owl-carousel product-carousel owl-theme">
                                        @foreach ($products as $prod)
                                            <div class="item">
                                                <div class="card">
                                                    <a href="/{{ $prod['slug'] }}.html"><img
                                                            style="height: 300px; width:100%"
                                                            src="../images/{{ $prod['urlHinh'] }}"></a>
                                                    <div class="card-body">
                                                        <h6 class="card-title">{{ $prod['tenDT'] }}</h6>
                                                        <p class="card-text">
                                                            <del class="float-end">{{ number_format($prod['gia'], 0, ',', '.') }}
                                                                VNĐ</del> <br>
                                                            <span
                                                                class="float-start">{{ number_format($prod['giaKM'], 0, ',', '.') }}
                                                                VNĐ</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div id='map' style='width: 100% !important; height: 600px !important;'></div>
                            @if ($branch['name'] == 'xPhone')
                                <script>
                                    mapboxgl.accessToken = 'pk.eyJ1IjoidHJhbmhhbyIsImEiOiJja3F1aDMxdTAwNGY5MnN0Zmw4bm90OGRyIn0.DywzSVxPfox7hMGW5Kj08w';
                                    var map = new mapboxgl.Map({
                                        container: 'map',
                                        style: 'mapbox://styles/mapbox/streets-v11',
                                        center: [106.692684, 10.78712734], // starting position
                                        zoom: 16 // starting zoom
                                    });
                                    var marker1 = new mapboxgl.Marker({color: 'red'})
                                        .setLngLat([106.692684, 10.78712734])
                                        .addTo(map);
                                    map.addControl(
                                        new MapboxDirections({
                                            accessToken: mapboxgl.accessToken
                                        }),
                                        'top-left'
                                    );

                                    map.on('load', function() {
                                        map.addSource('places', {
                                            'type': 'geojson',
                                            'data': {
                                                'type': 'FeatureCollection',
                                                'features': [{
                                                    'type': 'Feature',
                                                    'properties': {
                                                        'description': '<h6 style="font-weight: bold">{{ $branch['name'] }}</h6><p><i class="fa fa-phone"></i> {{ $branch['phone'] }}</p><p><i class="fa fa-map-marker"></i> {{ $branch['address'] }}</p>'
                                                    },
                                                    'geometry': {
                                                        'type': 'Point',
                                                        'coordinates': [106.692684, 10.78712734]
                                                    }
                                                }]
                                            }
                                        });
                                        map.addLayer({
                                            'id': 'places',
                                            'type': 'circle',
                                            'source': 'places',
                                            'paint': {
                                                'circle-color': 'red',
                                                'circle-radius': 4,
                                                'circle-stroke-width': 2,
                                                'circle-stroke-color': '#ffffff'
                                            }
                                        });
                                        var popup = new mapboxgl.Popup({
                                            closeButton: false,
                                            closeOnClick: false
                                        });

                                        map.on('mouseenter', 'places', function(e) {
                                            // Change the cursor style as a UI indicator.
                                            map.getCanvas().style.cursor = 'pointer';

                                            var coordinates = e.features[0].geometry.coordinates.slice();
                                            var description = e.features[0].properties.description;

                                            // Ensure that if the map is zoomed out such that multiple
                                            // copies of the feature are visible, the popup appears
                                            // over the copy being pointed to.
                                            while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
                                                coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
                                            }

                                            // Populate the popup and set its coordinates
                                            // based on the feature found.
                                            popup.setLngLat(coordinates).setHTML(description).addTo(map);
                                        });

                                        map.on('mouseleave', 'places', function() {
                                            map.getCanvas().style.cursor = '';
                                            popup.remove();
                                        });
                                    });
                                </script>
                            @elseif($branch['name'] == 'kPhone')
                                <script>
                                    mapboxgl.accessToken = 'pk.eyJ1IjoidHJhbmhhbyIsImEiOiJja3F1aDMxdTAwNGY5MnN0Zmw4bm90OGRyIn0.DywzSVxPfox7hMGW5Kj08w';
                                    var map = new mapboxgl.Map({
                                        container: 'map',
                                        style: 'mapbox://styles/mapbox/streets-v11',
                                        center: [106.681650, 10.796652], // starting position
                                        zoom: 16 // starting zoom
                                    });
                                    var marker1 = new mapboxgl.Marker({color: 'red'})
                                        .setLngLat([106.681650, 10.796652])
                                        .addTo(map);
                                    map.addControl(
                                        new MapboxDirections({
                                            accessToken: mapboxgl.accessToken
                                        }),
                                        'top-left'
                                    );
                                    map.on('load', function() {
                                        map.addSource('places', {
                                            'type': 'geojson',
                                            'data': {
                                                'type': 'FeatureCollection',
                                                'features': [{
                                                    'type': 'Feature',
                                                    'properties': {
                                                        'description': '<h6 style="font-weight: bold">{{ $branch['name'] }}</h6><p><i class="fa fa-phone"></i> {{ $branch['phone'] }}</p><p><i class="fa fa-map-marker"></i> {{ $branch['address'] }}</p>'
                                                    },
                                                    'geometry': {
                                                        'type': 'Point',
                                                        'coordinates': [106.681650, 10.796652]
                                                    }
                                                }]
                                            }
                                        });
                                        map.addLayer({
                                            'id': 'places',
                                            'type': 'circle',
                                            'source': 'places',
                                            'paint': {
                                                'circle-color': 'red',
                                                'circle-radius': 4,
                                                'circle-stroke-width': 2,
                                                'circle-stroke-color': '#ffffff'
                                            }
                                        });
                                        var popup = new mapboxgl.Popup({
                                            closeButton: false,
                                            closeOnClick: false
                                        });

                                        map.on('mouseenter', 'places', function(e) {
                                            // Change the cursor style as a UI indicator.
                                            map.getCanvas().style.cursor = 'pointer';

                                            var coordinates = e.features[0].geometry.coordinates.slice();
                                            var description = e.features[0].properties.description;

                                            // Ensure that if the map is zoomed out such that multiple
                                            // copies of the feature are visible, the popup appears
                                            // over the copy being pointed to.
                                            while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
                                                coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
                                            }

                                            // Populate the popup and set its coordinates
                                            // based on the feature found.
                                            popup.setLngLat(coordinates).setHTML(description).addTo(map);
                                        });

                                        map.on('mouseleave', 'places', function() {
                                            map.getCanvas().style.cursor = '';
                                            popup.remove();
                                        });
                                    });
                                </script>
                            @elseif($branch['name'] == 'zPhone')
                                <script>
                                    mapboxgl.accessToken = 'pk.eyJ1IjoidHJhbmhhbyIsImEiOiJja3F1aDMxdTAwNGY5MnN0Zmw4bm90OGRyIn0.DywzSVxPfox7hMGW5Kj08w';
                                    var map = new mapboxgl.Map({
                                        container: 'map',
                                        style: 'mapbox://styles/mapbox/streets-v11',
                                        center: [106.687279, 10.785420], // starting position
                                        zoom: 16 // starting zoom
                                    });
                                    var marker1 = new mapboxgl.Marker({color: 'red'})
                                        .setLngLat([106.687279, 10.785420])
                                        .addTo(map);
                                    map.addControl(
                                        new MapboxDirections({
                                            accessToken: mapboxgl.accessToken
                                        }),
                                        'top-left'
                                    );
                                    map.on('load', function() {
                                        map.addSource('places', {
                                            'type': 'geojson',
                                            'data': {
                                                'type': 'FeatureCollection',
                                                'features': [{
                                                    'type': 'Feature',
                                                    'properties': {
                                                        'description': '<h6 style="font-weight: bold">{{ $branch['name'] }}</h6><p><i class="fa fa-phone"></i> {{ $branch['phone'] }}</p><p><i class="fa fa-map-marker"></i> {{ $branch['address'] }}</p>'
                                                    },
                                                    'geometry': {
                                                        'type': 'Point',
                                                        'coordinates': [106.687279, 10.785420]
                                                    }
                                                }]
                                            }
                                        });
                                        map.addLayer({
                                            'id': 'places',
                                            'type': 'circle',
                                            'source': 'places',
                                            'paint': {
                                                'circle-color': 'red',
                                                'circle-radius': 4,
                                                'circle-stroke-width': 2,
                                                'circle-stroke-color': '#ffffff'
                                            }
                                        });
                                        var popup = new mapboxgl.Popup({
                                            closeButton: false,
                                            closeOnClick: false
                                        });

                                        map.on('mouseenter', 'places', function(e) {
                                            // Change the cursor style as a UI indicator.
                                            map.getCanvas().style.cursor = 'pointer';

                                            var coordinates = e.features[0].geometry.coordinates.slice();
                                            var description = e.features[0].properties.description;

                                            // Ensure that if the map is zoomed out such that multiple
                                            // copies of the feature are visible, the popup appears
                                            // over the copy being pointed to.
                                            while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
                                                coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
                                            }

                                            // Populate the popup and set its coordinates
                                            // based on the feature found.
                                            popup.setLngLat(coordinates).setHTML(description).addTo(map);
                                        });

                                        map.on('mouseleave', 'places', function() {
                                            map.getCanvas().style.cursor = '';
                                            popup.remove();
                                        });
                                    });
                                </script>
                            @elseif($branch['name'] == 'bPhone')
                                <script>
                                    mapboxgl.accessToken = 'pk.eyJ1IjoidHJhbmhhbyIsImEiOiJja3F1aDMxdTAwNGY5MnN0Zmw4bm90OGRyIn0.DywzSVxPfox7hMGW5Kj08w';
                                    var map = new mapboxgl.Map({
                                        container: 'map',
                                        style: 'mapbox://styles/mapbox/streets-v11',
                                        center: [106.691566, 10.786738], // starting position
                                        zoom: 16 // starting zoom
                                    });
                                    var marker1 = new mapboxgl.Marker({color: 'red'})
                                        .setLngLat([106.691566, 10.786738])
                                        .addTo(map);
                                    map.addControl(
                                        new MapboxDirections({
                                            accessToken: mapboxgl.accessToken
                                        }),
                                        'top-left'
                                    );
                                    map.on('load', function() {
                                        map.addSource('places', {
                                            'type': 'geojson',
                                            'data': {
                                                'type': 'FeatureCollection',
                                                'features': [{
                                                    'type': 'Feature',
                                                    'properties': {
                                                        'description': '<h6 style="font-weight: bold">{{ $branch['name'] }}</h6><p><i class="fa fa-phone"></i> {{ $branch['phone'] }}</p><p><i class="fa fa-map-marker"></i> {{ $branch['address'] }}</p>'
                                                    },
                                                    'geometry': {
                                                        'type': 'Point',
                                                        'coordinates': [106.691566, 10.786738]
                                                    }
                                                }]
                                            }
                                        });
                                        map.addLayer({
                                            'id': 'places',
                                            'type': 'circle',
                                            'source': 'places',
                                            'paint': {
                                                'circle-color': 'red',
                                                'circle-radius': 4,
                                                'circle-stroke-width': 2,
                                                'circle-stroke-color': '#ffffff'
                                            }
                                        });
                                        var popup = new mapboxgl.Popup({
                                            closeButton: false,
                                            closeOnClick: false
                                        });

                                        map.on('mouseenter', 'places', function(e) {
                                            // Change the cursor style as a UI indicator.
                                            map.getCanvas().style.cursor = 'pointer';

                                            var coordinates = e.features[0].geometry.coordinates.slice();
                                            var description = e.features[0].properties.description;

                                            // Ensure that if the map is zoomed out such that multiple
                                            // copies of the feature are visible, the popup appears
                                            // over the copy being pointed to.
                                            while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
                                                coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
                                            }

                                            // Populate the popup and set its coordinates
                                            // based on the feature found.
                                            popup.setLngLat(coordinates).setHTML(description).addTo(map);
                                        });

                                        map.on('mouseleave', 'places', function() {
                                            map.getCanvas().style.cursor = '';
                                            popup.remove();
                                        });
                                    });
                                </script>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

</body>

</html>
