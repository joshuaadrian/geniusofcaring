import * as L from "leaflet";
import { GestureHandling } from "leaflet-gesture-handling";
import { MarkerClusterGroup } from "leaflet.markercluster/src";

// var locationsJSON = [

//   {
//     name    : 'Kuwait',
//     address : '<strong>WIC NY</strong><br>Al Soor Street, Twin Towers,<br>21st Floor, Block A<br>Mirqab, Kuwait City',
//     phone   : '<strong>P. +965 222.663.52</strong>',
//     image   : '/wp-content/themes/wafra/dist/images/locations/kuwait.jpg',
//     type    : 'office',
//     lat     : 29.372881,
//     lng     : 47.990540
//   },
//   {
//     name    : 'London',
//     address : '<strong>WEL</strong><br>27 Knightsbridge<br>London<br>SW1X 7LY',
//     phone   : '<strong>P. +44 (0) 203.966.9865</strong>',
//     image   : '/wp-content/themes/wafra/dist/images/locations/london.jpg',
//     type    : 'office',
//     lat     : 51.5022252,
//     lng     : -0.1552383
//   },
//   {
//     name    : 'Bermuda',
//     address : '<strong>WFMS</strong><br>Ideation House, 94 Pitts Bay Road, 1st Floor, Pembroke HM 08, Bermuda',
//     phone   : '<strong>P. +1 441.405.3700</strong>',
//     image   : '/wp-content/themes/wafra/dist/images/locations/bermuda.jpg',
//     type    : 'office',
//     lat     : 32.298590,
//     lng     : -64.786930
//   },
//   {
//     name    : 'New York',
//     address : '<strong>WIC NY</strong><br>345 Park Avenue, 41st Floor<br>New York, NY 10154-0101',
//     phone   : '<strong>P. +1 212.759.3700</strong>',
//     image   : '/wp-content/themes/wafra/dist/images/locations/new-york.jpg',
//     type    : 'headquarters',
//     lat     : 40.757720,
//     lng     : -73.972350
//   }

// ];

$(document).ready(function() {

  var winWidth = $(window).width();

  if ( $('#map').length > 0 && winWidth > 991 ) {

    //patchMapTileGapBug();
    // ...
    function patchMapTileGapBug () {

        // Workaround for 1px lines appearing in some browsers due to fractional transforms
        // and resulting anti-aliasing. adapted from @cmulders' solution:
        // https://github.com/Leaflet/Leaflet/issues/3575#issuecomment-150544739
        let originalInitTile = L.GridLayer.prototype._initTile;
        if (originalInitTile.isPatched) return;

        L.GridLayer.include({
            _initTile: function (tile) {
                originalInitTile.call(this, tile);

                var tileSize = this.getTileSize();

                tile.style.width = tileSize.x + 1 + 'px';
                tile.style.height = tileSize.y + 1 + 'px';
            }
        });

        L.GridLayer.prototype._initTile.isPatched = true;

    }

    L.Map.addInitHook("addHandler", "gestureHandling", GestureHandling);

    var mapboxAccessToken = 'pk.eyJ1Ijoiam9zaHVhYWRyaWFuIiwiYSI6ImNrcWg3M3RncjE3azMyb251YmtjY3gyZWUifQ.kB3LT17nV87JvvwSJvFIIg';

    var mymap = L.map( 'map', {
      gestureHandling: true,
      zoomDelta: 0.5,
      zoomSnap: 0,
    })
    .setView([24, 8], 2.75);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoiam9zaHVhYWRyaWFuIiwiYSI6ImNrcWg3M3RncjE3azMyb251YmtjY3gyZWUifQ.kB3LT17nV87JvvwSJvFIIg', {
      attribution: '',
      maxZoom: 4,
      minZoom : 2,
      id: 'joshuaadrian/cllkzbiy702a601qr66wm3gw9',
      //id: mapJSON.mapboxStyles,
      tileSize: 512,
      noWrap:true,
      tap: false,
      zoomOffset: -1,
      dragging: !L.Browser.mobile,
      bounds: [
        [-90, -180],
        [90, 180]
      ],
      accessToken: mapboxAccessToken
    }).addTo(mymap);

    var markers = new MarkerClusterGroup({
      spiderLegPolylineOptions:{ weight: 1.5, color: '#222', opacity: 0 },
      //spiderfyOnMaxZoom: false,
      showCoverageOnHover:false
    });

    function setMarkers() {

      var officeIcon = L.icon({
        iconUrl: '/wp-content/themes/evercore-investment/dist/images/icon-office.svg',
        shadowUrl: '',
        iconSize:     [20,20], // size of the icon
        shadowSize:   [24, 21], // size of the shadow
        iconAnchor:   [15,15], // point of the icon which will correspond to marker's location
        shadowAnchor: [-10, -18],  // the same for the shadow
        popupAnchor:  [350, 300] // point from which the popup should open relative to the iconAnchor
      });

      var allianceIcon = L.icon({
        iconUrl: '/wp-content/themes/evercore-investment/dist/images/icon-alliance.svg',
        shadowUrl: '',
        iconSize:     [20,20], // size of the icon
        shadowSize:   [24, 21], // size of the shadow
        iconAnchor:   [15,15], // point of the icon which will correspond to marker's location
        shadowAnchor: [-10, -18],  // the same for the shadow
        popupAnchor:  [350, 300] // point from which the popup should open relative to the iconAnchor
      });

      for (let myLocations = 0; myLocations < locationsJSON.length; myLocations++) {

        var iconType = locationsJSON[myLocations].type.indexOf('strategic-alliance') != -1 ? allianceIcon : officeIcon;

        if (
          typeof locationsJSON[myLocations].lat !== "undefined"
          && typeof locationsJSON[myLocations].lng !== "undefined"
        ) {

          var latLng = [locationsJSON[myLocations].lat, locationsJSON[myLocations].lng];
          var popupContent = '<div class="map--popup"><div class="map--popup--image" style="background-image:url('+locationsJSON[myLocations].image+')"></div><div class="map--popup--content"><h3>'+ locationsJSON[myLocations].name + '</h3><p>'+locationsJSON[myLocations].address + '</p><div class="map--popup--businesses"><h4>Our Capabilities</h4><p>' + locationsJSON[myLocations].businesses + '</p></div></div></div>';
          markers.addLayer(L.marker(latLng,{icon: iconType}).bindPopup(popupContent));

          //var marker = L.marker(latLng,{icon: iconType}).bindPopup(popupContent).addTo(mymap);

        }

      }

      mymap.addLayer(markers);
      //mymap.fitBounds(markers.getBounds());

    }

    setMarkers();

  };

});
