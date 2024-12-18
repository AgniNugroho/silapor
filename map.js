let mapOptions = {
	center: [-7.811684223567514, 110.37277221679689],
	zoom: 10,
};

let map = new L.map("map", mapOptions);
let layer = new L.TileLayer(
	"http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
);
map.addLayer(layer);

let marker = null;
map.on("click", (e) => {
	if (marker !== null) {
		map.removeLayer(marker);
	}
	marker = L.marker([e.latlng.lat, e.latlng.lng]).addTo(map);

	document.getElementById("latitude").value = e.latlng.lat;
	document.getElementById("longitude").value = e.latlng.lng;
});
