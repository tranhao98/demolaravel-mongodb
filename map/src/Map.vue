<template>
    <div id="map"></div>
</template>
<script>
import mapboxgl from "mapbox-gl";
import "mapbox-gl/dist/mapbox-gl.css";
import { onMounted } from "vue";
import MapboxGeocoder from "@mapbox/mapbox-gl-geocoder";
import "@mapbox/mapbox-gl-geocoder/dist/mapbox-gl-geocoder.css";
import MapboxDraw from "@mapbox/mapbox-gl-draw";
import "@mapbox/mapbox-gl-draw/dist/mapbox-gl-draw.css";
export default {
    setup() {
        onMounted(() => {
            mapboxgl.accessToken =
                "pk.eyJ1IjoidHJhbmhhbyIsImEiOiJja3F1aDMxdTAwNGY5MnN0Zmw4bm90OGRyIn0.DywzSVxPfox7hMGW5Kj08w";
            var instructions = document.getElementById("instructions");
            var map = new mapboxgl.Map({
                container: "map",
                style: "mapbox://styles/tranhao/ckqulfvew0a9m17mo1c5tk7ak", //hosted style id
                center: [106.7, 10.77],
                zoom: 13,
                minZoom: 11
            });
            var geocoder = new MapboxGeocoder({
                accessToken: mapboxgl.accessToken
            });

            map.on("load", function() {
                geocoder.on("result", function(ev) {
                    console.log(ev.result.center);
                });
            });
            var draw = new MapboxDraw({
                displayControlsDefault: false,
                controls: {
                    line_string: true,
                    trash: true
                },
                styles: [
                    {
                        id: "gl-draw-line",
                        type: "line",
                        filter: [
                            "all",
                            ["==", "$type", "LineString"],
                            ["!=", "mode", "static"]
                        ],
                        layout: {
                            "line-cap": "round",
                            "line-join": "round"
                        },
                        paint: {
                            "line-color": "#3b9ddd",
                            "line-dasharray": [0.2, 2],
                            "line-width": 4,
                            "line-opacity": 0.7
                        }
                    },

                    {
                        id: "gl-draw-polygon-and-line-vertex-halo-active",
                        type: "circle",
                        filter: [
                            "all",
                            ["==", "meta", "vertex"],
                            ["==", "$type", "Point"],
                            ["!=", "mode", "static"]
                        ],
                        paint: {
                            "circle-radius": 10,
                            "circle-color": "#FFF"
                        }
                    },

                    {
                        id: "gl-draw-polygon-and-line-vertex-active",
                        type: "circle",
                        filter: [
                            "all",
                            ["==", "meta", "vertex"],
                            ["==", "$type", "Point"],
                            ["!=", "mode", "static"]
                        ],
                        paint: {
                            "circle-radius": 6,
                            "circle-color": "#3b9ddd"
                        }
                    }
                ]
            });

            map.addControl(draw);

            map.on("draw.create", updateRoute);
            map.on("draw.update", updateRoute);
            map.on("draw.delete", removeRoute);

            function updateRoute() {
                removeRoute();
                var data = draw.getAll();
                var lastFeature = data.features.length - 1;
                var coords = data.features[lastFeature].geometry.coordinates;
                var newCoords = coords.join(";");
                getMatch(newCoords);
            }

            function getMatch(e) {
                var url =
                    "https://api.mapbox.com/directions/v5/mapbox/cycling/" +
                    e +
                    "?geometries=geojson&steps=true&access_token=" +
                    mapboxgl.accessToken;
                var req = new XMLHttpRequest();
                req.responseType = "json";
                req.open("GET", url, true);
                req.onload = function() {
                    var jsonResponse = req.response;
                    var distance = jsonResponse.routes[0].distance * 0.001;
                    var duration = jsonResponse.routes[0].duration / 60;
                    var steps = jsonResponse.routes[0].legs[0].steps;
                    var coords = jsonResponse.routes[0].geometry;
                    console.log(steps);
                    console.log(coords);
                    console.log(distance);
                    console.log(duration);

                    steps.forEach(function(step) {
                        instructions.insertAdjacentHTML(
                            "beforeend",
                            "<p>" + step.maneuver.instruction + "</p>"
                        );
                    });

                    instructions.insertAdjacentHTML(
                        "beforeend",
                        "<p>" +
                            "Distance: " +
                            distance.toFixed(2) +
                            " km<br>Duration: " +
                            duration.toFixed(2) +
                            " minutes" +
                            "</p>"
                    );

                    addRoute(coords);
                };
                req.send();
            }

            function addRoute(coords) {
                if (map.getSource("route")) {
                    map.removeLayer("route");
                    map.removeSource("route");
                } else {
                    map.addLayer({
                        id: "route",
                        type: "line",
                        source: {
                            type: "geojson",
                            data: {
                                type: "Feature",
                                properties: {},
                                geometry: coords
                            }
                        },
                        layout: {
                            "line-join": "round",
                            "line-cap": "round"
                        },
                        paint: {
                            "line-color": "#1db7dd",
                            "line-width": 8,
                            "line-opacity": 0.8
                        }
                    });
                }
            }

            function removeRoute() {
                if (map.getSource("route")) {
                    map.removeLayer("route");
                    map.removeSource("route");
                    instructions.innerHTML = "";
                } else {
                    return;
                }
            }
            document
                .getElementById("geocoder")
                .appendChild(geocoder.onAdd(map));
        });
        return {};
    }
};
</script>

<style>
#map {
    height: 100vh;
}
.geocoder {
    position: absolute;
    top: 20px;
    left: 70px;
    padding: 15px;
    text-align: left;
    font-family: "Arial";
    margin: 0;
    font-size: 13px;
}

#instructions {
    position: absolute;
    height: 500px;
    margin: 20px;
    width: 25%;
    top: 0;
    bottom: 0;
    padding: 20px;
    padding-top: 50px;
    background-color: rgba(255, 255, 255, 0.5);
    overflow-y: scroll;
    font-family: sans-serif;
}
</style>
