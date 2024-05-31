document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const ville = urlParams.get('ville');

    const monumentsList = document.getElementById("monuments-list");
    const monumentDetails = document.getElementById("monument-details");
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

    function getMonumentsByVille(ville) {
        fetch(`monuments_${ville}.json`)
            .then(response => response.json())
            .then(monuments => {
                monuments.forEach((monument, index) => {
                    const listItem = document.createElement("li");
                    listItem.classList.add("monument-item");

                    const image = document.createElement("img");
                    image.src = `img/${monument.image}`;
                    image.alt = monument.name;
                    image.classList.add("monument-image");

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

    if (ville) {
        getMonumentsByVille(ville);
    } else {
        console.error('Ville non spécifiée dans l\'URL.');
    }

    function displayMonumentDetails(monument) {
        const details = {
            location: langData.location,
            history: langData.history,
            price: langData.price,
            open: langData.open


        };

        monumentDetails.innerHTML = `
            <h2>${monument.name}</h2>
            <p><strong>${details.location} :</strong> ${monument.location}</p>
            <p><strong>${details.history} :</strong> ${monument.history[lang]}</p>
            <p><strong>${details.price} :</strong> ${monument.prix}</p>
            <p><strong>${details.open} :</strong> ${monument.horaires}</p>

            

        `;
    }

    function showMonumentOnMap(monument) {
        markers.forEach(marker => marker.remove());
        markers.length = 0;

        map.setView([monument.lat, monument.long], 13);

        const marker = L.marker([monument.lat, monument.long], 12).addTo(map);

        const popupContent = `
            <div class="custom-popup">
                <b>${monument.name}</b>
                <br><img src="img/${monument.image}" alt="${monument.name}" class="popup-image">
            </div>
        `;

        marker.bindPopup(popupContent).openPopup();

        markers.push(marker);
    }
});
