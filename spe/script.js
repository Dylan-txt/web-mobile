document.addEventListener("DOMContentLoaded", function () {
    const monumentsList = document.getElementById("monuments-list");
    const monumentDetails = document.getElementById("monument-details");
    const map = L.map('map').setView([48.8566, 2.3522], 12); // Coordonnées par défaut (Paris)

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    const markers = [];

    // Récupérer la ville à partir de l'URL
    const urlParams = new URLSearchParams(window.location.search);
    const ville = urlParams.get('ville');

    // Fonction pour récupérer et afficher les monuments en fonction de la ville sélectionnée
    function getMonumentsByVille(ville) {
        fetch(`monuments_${ville}.json`) // Supposons que les données des monuments pour chaque ville sont stockées dans des fichiers JSON distincts (ex: monuments_paris.json)
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
            })
            .catch(error => {
                console.error('Error fetching monuments data:', error);
            });
    }

    // Appeler la fonction pour afficher les monuments de la ville sélectionnée
    if (ville) {
        getMonumentsByVille(ville);
    } else {
        console.error('Ville non spécifiée dans l\'URL.');
    }

    function displayMonumentDetails(monument) {
        monumentDetails.innerHTML = `
            <h2>${monument.name}</h2>
            <p><strong>Emplacement:</strong> ${monument.location}</p>
            <p><strong>Histoire:</strong> ${monument.history}</p>
        `;
    }

    function showMonumentOnMap(monument) {
        // On enlève les anciens marqueurs
        markers.forEach(marker => marker.remove());
        markers.length = 0;

        const marker = L.marker([monument.lat, monument.long], 12).addTo(map);

        const popupContent = `
            <div class="custom-popup">
                <b>${monument.name}</b>
                <br>${monument.location}
                <br><img src="img/${monument.image}" alt="${monument.name}" class="popup-image">
                <br><span id="close-popup" class="popup-close">&#10006;</span>
            </div>
        `;

        marker.bindPopup(popupContent).openPopup();

        // Ajuster la vue de la carte pour que le popup s'affiche en entier
        const popupLatLng = marker.getLatLng();
        const popupSize = L.point(200, 160); // Ajustez la taille du popup en fonction de vos besoins
        const popupAnchor = marker.getPopup().options.anchor;

        const topLeft = map.layerPointToLatLng(popupLatLng, map.zoom).add(L.point(-popupAnchor[0], -popupAnchor[1]));
        const bottomRight = map.layerPointToLatLng(popupLatLng, map.zoom).add(L.point(popupSize.x - popupAnchor[0], popupSize.y - popupAnchor[1]));

        map.fitBounds(L.latLngBounds(topLeft, bottomRight));

        // Fermer le popup lorsqu'on clique sur la croix
        const popupClose = document.querySelector(".leaflet-popup-content .custom-popup .popup-close");
        popupClose.addEventListener("click", () => {
            marker.closePopup();
        });

        markers.push(marker);
    }
});
