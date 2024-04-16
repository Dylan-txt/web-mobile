document.addEventListener("DOMContentLoaded", function () {
    // Récupérer la ville à partir de l'URL
    const urlParams = new URLSearchParams(window.location.search);
    const ville = urlParams.get('ville');

    const monumentsList = document.getElementById("monuments-list");
    const monumentDetails = document.getElementById("monument-details");
    const backButton = document.getElementById("back-button");
    const mapContainer = document.getElementById("map");
    let map = null;

    switch (ville) {
        case 'paris':
            map = L.map('map').setView([48.8566, 2.3522], 12); // Coordonnées par défaut (Paris)
            break;
        case 'marseille':
            map = L.map('map').setView([43.299999, 5.4], 12); // Coordonnées Marseille
            break;
        case 'lyon':
            map = L.map('map').setView([45.7640430, 4.8356590], 12); // Coordonnées Lyon
            break;
    }

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    const markers = [];

let hideSide = document.getElementById("hideSidebar");
let sideBar = document.getElementById("sidebar");
hideSide.addEventListener("click", () => {
  if(getComputedStyle(sideBar).display != "none"){
    sideBar.style.display = "none";
  } else {
    sideBar.style.display = "block";
  }
})

    // Fonction pour récupérer et afficher les monuments en fonction de la ville sélectionnée
    function getMonumentsByVille(ville) {
        fetch(`monuments_${ville}.json`) // Supposons que les données des monuments pour chaque ville sont stockées dans des fichiers JSON distincts (ex: monuments_paris.json)
            .then(response => response.json())
            .then(monuments => {
                monuments.forEach((monument, index) => {
                    const listItem = document.createElement("li");
                    listItem.classList.add("monument-item");

                    // Création de l'image miniature
                    const image = document.createElement("img");
                    image.src = `img/${monument.image}`;
                    image.alt = monument.name;
                    image.classList.add("monument-image");

                    // Création du titre
                    const title = document.createElement("span");
                    title.textContent = monument.name;
                    title.classList.add("monument-title");
                    listItem.addEventListener("click", () => {
                        displayMonumentDetails(monument);
                        showMonumentOnMap(monument);
                    });
                    listItem.appendChild(image);
                    listItem.appendChild(title);
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

        // Créer un contenu pour le popup avec les détails du monument
        map.setView([monument.lat, monument.long], 13);

        const marker = L.marker([monument.lat, monument.long], 12).addTo(map);

        const popupContent = `
            <div class="custom-popup">
                <b>${monument.name}</b>
                <br>${monument.location}
                <br><img src="img/${monument.image}" alt="${monument.name}" class="popup-image">
            </div>
        `;

        marker.bindPopup(popupContent).openPopup();

        // Ajuster la vue de la carte pour que le popup s'affiche en entier
        const popupLatLng = marker.getLatLng();
        const popupSize = L.point(140, 112); // Ajustez la taille du popup
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









