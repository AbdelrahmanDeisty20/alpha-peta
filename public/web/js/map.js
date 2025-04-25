

function initAutocomplete() {
    let lat = parseFloat($("input[name='lat']").val());
    let lng = parseFloat($("input[name='lng']").val());
    let address = document.getElementById("map").getAttribute("data-address");

    const map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: lat, lng: lng },
        zoom: 12,
        mapTypeId: "roadmap",
    });

    let markers = [];

    // Assuming you have a valid place object with name and geometry properties
    let place = {
        name: address,
        geometry: {
            location: { lat: lat, lng: lng }
        }
    };

    let marker = new google.maps.Marker({
        map: map,
        title: place.name,
        position: place.geometry.location,
    });

    markers.push(marker);
}
