<template>
    <div id="map"></div>
</template>

<script>
import mapboxgl from "mapbox-gl";
import "mapbox-gl/dist/mapbox-gl.css";
import MapboxDirections from "@mapbox/mapbox-gl-directions/dist/mapbox-gl-directions";
import "@mapbox/mapbox-gl-directions/dist/mapbox-gl-directions.css";
import { MglMap } from "vue-mapbox";

export default {
    components: {
        MglMap
    },
    data() {
        var instructions = document.getElementById("instructions");
        return {
            accessToken:
                "pk.eyJ1IjoidHJhbmhhbyIsImEiOiJja3F1aDMxdTAwNGY5MnN0Zmw4bm90OGRyIn0.DywzSVxPfox7hMGW5Kj08w", // your access token. Needed if you using Mapbox maps
            mapStyle: "mapbox://styles/tranhao/ckqulfvew0a9m17mo1c5tk7ak",
            center: [106.7, 10.77],
            zoom: 13
        };
    },
    mounted() {
        this.created();
    },
    methods: {
        created() {
            // We need to set mapbox-gl library here in order to use it in template
            var map = new mapboxgl.Map({
                accessToken: this.accessToken,
                container: "map",
                style: this.mapStyle,
                minZoom: 0,
                center: this.center, // use initial data as default
                zoom: this.zoom,
                hash: true
            });
            map.addControl(
                new MapboxDirections({
                    accessToken: this.accessToken
                }),
                "top-right"
            );
            map.on("mousemove", function(e) {
                document.getElementById("info").innerHTML =
                    // e.point is the x, y coordinates of the mousemove event relative
                    // to the top-left corner of the map
                    JSON.stringify(e.point) +
                    "<br />" +
                    // e.lngLat is the longitude, latitude geographical position of the event
                    JSON.stringify(e.lngLat.wrap());
            });
        }
    }
};
</script>
<style>
#map {
    height: 100vh;
}
</style>
