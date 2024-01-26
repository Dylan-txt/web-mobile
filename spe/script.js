document.addEventListener("DOMContentLoaded", function () {
    const monumentsList = document.getElementById("monuments-list");
    const monumentDetails = document.getElementById("monument-details");

    const map = L.map('map').setView([48.8566, 2.3522], 12); // Paris
    // A changer si selection de ville avant

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    const markers = [];

    fetch('monuments.json')
        .then(response => response.json())
        .then(monuments => {
            monuments.forEach((monument, index) => {
                const listItem = document.createElement("li");
                listItem.textContent = monument.name;
                listItem.addEventListener("click", () => {
                    displayMonumentDetails(monument);
                    showMonumentOnMap(monument);
                });
                monumentsList.appendChild(listItem);
            });
        });

    function displayMonumentDetails(monument) {
        monumentDetails.innerHTML = `
            <h2>${monument.name}</h2>
            <p><strong>Emplacement:</strong> ${monument.location}</p>
            <p><strong>Histoire:</strong> ${monument.history}</p>
            
        `;
        //Rajouter d'autre infos (Horaires d'ouverture, prix ...)
        // API Wikipedia ??
    }

    function showMonumentOnMap(monument) {

        //On enleve les anciens marqueurs
        markers.forEach(marker => marker.remove());
        markers.length = 0;

        const marker = L.marker([monument.lat, monument.long],12)
            .bindPopup(`<b>${monument.name}</b><br>${monument.location}`)
            .addTo(map);

        markers.push(marker);

        map.setView(marker.getLatLng(), 15);
        //Mettre en place un parcours ? Itinéraire ? 
    }

    /* ---------------- Fonction de test
    function getRandomCoordinate() {
        return Math.random() * 0.02 - 0.01;
    }
    */
});
