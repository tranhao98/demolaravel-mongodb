<template>
  <div id="map" class="map"></div>
</template>
<script>
if (!("remove" in Element.prototype)) {
  Element.prototype.remove = function () {
    if (this.parentNode) {
      this.parentNode.removeChild(this);
    }
  };
}
import mapboxgl from "mapbox-gl";
import "mapbox-gl/dist/mapbox-gl.css";
import MapboxDirections from "@mapbox/mapbox-gl-directions/dist/mapbox-gl-directions";
import "@mapbox/mapbox-gl-directions/dist/mapbox-gl-directions.css";
import { MglMap } from "vue-mapbox";
export default {
  components: {
    MglMap,
  },
  data() {
    return {
      accessToken:
        "pk.eyJ1IjoidHJhbmhhbyIsImEiOiJja3F1aDMxdTAwNGY5MnN0Zmw4bm90OGRyIn0.DywzSVxPfox7hMGW5Kj08w", // your access token. Needed if you using Mapbox maps
      mapStyle: "mapbox://styles/tranhao/ckqulfvew0a9m17mo1c5tk7ak",
      center: [106.68959, 10.784731],
      zoom: 13,
    };
  },
  mounted() {
    this.created();
  },
  methods: {
    created() {
      var map = new mapboxgl.Map({
        accessToken: this.accessToken,
        container: "map",
        style: this.mapStyle,
        minZoom: 0,
        center: this.center, // use initial data as default
        zoom: this.zoom,
      });
      var stores = {
        type: "FeatureCollection",
        features: [
          {
            type: "Feature",
            geometry: {
              type: "Point",
              coordinates: [106.691566, 10.786738],
            },
            properties: {
              phoneFormatted: "0937.488.221",
              phone: "0937488221",
              address: "106 Pham Ngoc Thach District 3, Ho Chi Minh City",
              city: "Ho Chi Minh City",
              country: "VietNam",
              state: "Ho Chi Minh",
            },
          },
          {
            type: "Feature",
            geometry: {
              type: "Point",
              coordinates: [106.687279, 10.78542],
            },
            properties: {
              phoneFormatted: "0741.226.648",
              phone: "0741226648",
              address: "87 Tran Quoc Toan, District 3, Ho Chi Minh City",
              city: "Ho Chi Minh City",
              country: "VietNam",
              state: "Ho Chi Minh",
            },
          },
          {
            type: "Feature",
            geometry: {
              type: "Point",
              coordinates: [106.68165, 10.796652],
            },
            properties: {
              phoneFormatted: "0794.412.236",
              phone: "0794412236",
              address:
                "287 Phan Dinh Phung, Phu Nhuan District, Ho Chi Minh City",
              city: "Ho Chi Minh City",
              country: "VietNam",
              state: "Ho Chi Minh",
            },
          },
          {
            type: "Feature",
            geometry: {
              type: "Point",
              coordinates: [106.692684, 10.78712734],
            },
            properties: {
              phoneFormatted: "0902.448.662",
              phone: "0902448662",
              address: "281 Hai Ba Trung, District 3, Ho Chi Minh City",
              city: "Ho Chi Minh City",
              country: "VietNam",
              state: "Ho Chi Minh",
            },
          },
        ],
      };
      stores.features.forEach(function (store, i) {
        store.properties.id = i;
      });
      map.addControl(
        new MapboxDirections({
          accessToken: this.accessToken,
        }),
        "top-right"
      );
      map.on("mousemove", function (e) {
        document.getElementById("info").innerHTML =
          // e.point is the x, y coordinates of the mousemove event relative
          // to the top-left corner of the map
          JSON.stringify(e.point) +
          "<br />" +
          // e.lngLat is the longitude, latitude geographical position of the event
          JSON.stringify(e.lngLat.wrap());
      });
      map.on("load", function (e) {
        /* Add the data to your map as a layer */
        map.addSource("places", {
          type: "geojson",
          data: stores,
        });
        addMarkers();
        buildLocationList(stores);
      });
      function addMarkers() {
        /* For each feature in the GeoJSON object above: */
        stores.features.forEach(function (marker) {
          /* Create a div element for the marker. */
          var el = document.createElement("div");
          /* Assign a unique `id` to the marker. */
          el.id = "marker-" + marker.properties.id;
          /* Assign the `marker` class to each marker for styling. */
          el.className = "marker";

          /**
           * Create a marker using the div element
           * defined above and add it to the map.
           **/
          new mapboxgl.Marker(el, { offset: [0, -23] })
            .setLngLat(marker.geometry.coordinates)
            .addTo(map);
          el.addEventListener("click", function (e) {
            /* Fly to the point */
            flyToStore(marker);
            /* Close all other popups and display popup for clicked store */
            createPopUp(marker);
            /* Highlight listing in sidebar */
            var activeItem = document.getElementsByClassName("active");
            e.stopPropagation();
            if (activeItem[0]) {
              activeItem[0].classList.remove("active");
            }
            var listing = document.getElementById(
              "listing-" + marker.properties.id
            );
            listing.classList.add("active");
          });
        });
      }
      function buildLocationList(data) {
        data.features.forEach(function (store, i) {
          /**
           * Create a shortcut for `store.properties`,
           * which will be used several times below.
           **/
          var prop = store.properties;

          /* Add a new listing section to the sidebar. */
          var listings = document.getElementById("listings");
          var listing = listings.appendChild(document.createElement("div"));
          /* Assign a unique `id` to the listing. */
          listing.id = "listing-" + data.features[i].properties.id;
          /* Assign the `item` class to each listing for styling. */
          listing.className = "item";

          /* Add the link to the individual listing created above. */
          var link = listing.appendChild(document.createElement("a"));
          link.href = "#";
          link.className = "title";
          link.id = "link-" + prop.id;
          link.innerHTML = prop.address;

          /* Add details to the individual listing. */
          var details = listing.appendChild(document.createElement("div"));
          details.innerHTML = prop.city;
          if (prop.phone) {
            details.innerHTML += " · " + prop.phoneFormatted;
          }
          if (prop.distance) {
            var roundedDistance = Math.round(prop.distance * 100) / 100;
            details.innerHTML +=
              "<p><strong>" + roundedDistance + " miles away</strong></p>";
          }
          link.addEventListener("click", function (e) {
            for (var i = 0; i < data.features.length; i++) {
              if (this.id === "link-" + data.features[i].properties.id) {
                var clickedListing = data.features[i];
                flyToStore(clickedListing);
                createPopUp(clickedListing);
              }
            }
            var activeItem = document.getElementsByClassName("active");
            if (activeItem[0]) {
              activeItem[0].classList.remove("active");
            }
            this.parentNode.classList.add("active");
          });
        });
      }
      function flyToStore(currentFeature) {
        map.flyTo({
          center: currentFeature.geometry.coordinates,
          zoom: 15,
        });
      }

      function createPopUp(currentFeature) {
        var popUps = document.getElementsByClassName("mapboxgl-popup");
        /** Check if there is already a popup on the map and if so, remove it */
        if (popUps[0]) popUps[0].remove();

        var popup = new mapboxgl.Popup({ closeOnClick: false })
          .setLngLat(currentFeature.geometry.coordinates)
          .setHTML(
            "<h3>Location & Contact</h3>" +
              "<h4>" + "<i class='fa fa-map-marker'></i> "+
              currentFeature.properties.address +
              "</h4>" + 
              "<h4>" + "<i class='fa fa-phone'></i> "+
              currentFeature.properties.phoneFormatted +
              "</h4>" 

          )
          .addTo(map);
      }
    },
  },
};
</script>