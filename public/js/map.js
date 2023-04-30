// We initialise the latitude and longitude of Liège (centre of the map)
var lat = 50.6333;
var lon = 5.56667;
var mymap = null;

// Card initialization function
function initMap() {
  // Create the "mymap" object and insert it into the HTML element with the ID "map
  mymap = L.map("map").setView([lat, lon], 11);
  // Leaflet does not retrieve tiles from a server by default.
  //We have to specify where we want to get them. Here, openstreetmap.fr
  L.tileLayer("https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png", {
    // the link to the data source
    attribution:
      'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
    minZoom: 1,
    maxZoom: 20,
  }).addTo(mymap);
  // We add a marker
  var marker = L.marker([lat, lon]).addTo(mymap);
  marker.bindPopup("<h3>Liège</h3>");
}
window.onload = function () {
  // Initialization function that runs when the DOM is loaded
  initMap();
};
