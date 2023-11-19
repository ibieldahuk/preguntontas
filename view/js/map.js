const mapDiv = document.getElementById("map");
const coord = { lat: -34.0, lng: -64.0 }
let map;
let marker;
let geocoder;

function initMap(){
    map = new google.maps.Map(mapDiv, {coord, zoom: 8,});
    marker = new google.maps.Marker({
        position: coord,
        map: map,
    });
    geocoder = new google.maps.Geocoder();
    function zoomToPolygon(placeid) {
        geocoder
            .geocode({ placeId: placeid })
            .then(({ results }) => {
                map.fitBounds(results[0].geometry.viewport, 155);
            })
            .catch((e) => {
                console.log('Geocoder failed due to: ' + e)
            });
    }
}