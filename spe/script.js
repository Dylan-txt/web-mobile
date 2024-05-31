document.addEventListener("DOMContentLoaded", function () {
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
        if (getComputedStyle(sideBar).display != "none") {
            sideBar.style.display = "none";
        } else {
            sideBar.style.display = "block";
        }
    });

    function getMonumentsByVille(ville) {
        fetch(`monuments_${ville}.json`) // Supposons que les données des monuments pour chaque ville sont stockées dans des fichiers JSON distincts (ex: monuments_paris.json)
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
        monumentDetails.innerHTML = `
            <h2>${monument.name}</h2>
            <p><strong>Emplacement:</strong> ${monument.location}</p>
            <p><strong>Histoire:</strong> ${monument.history}</p>
            <h4>Commentaires</h4>
            <div id="comments-section">
                <ul id="comments-list"></ul>
                <textarea id="new-comment"></textarea>
                <button id="post-comment">Post Comment</button>
            </div>
        `;

        const postCommentButton = document.getElementById('post-comment');
        postCommentButton.addEventListener('click', () => {
            const commentText = document.getElementById('new-comment').value.trim();
            if (commentText) {
                postComment(monument.name, userId, commentText);
            }
        });

        fetchComments(monument.name);
    }

    function showMonumentOnMap(monument) {
        markers.forEach(marker => marker.remove());
        markers.length = 0;

        map.setView([monument.lat, monument.long], 13);

        const marker = L.marker([monument.lat, monument.long], 12).addTo(map);

        const popupContent = `
            <div class="custom-popup">
                <b>${monument.name}</b>
                <br>${monument.location}
                <br><img src="img/${monument.image}" alt="${monument.name}" class="popup-image">
                <div id="comment-section-${monument.name}"></div>
            </div>
        `;

        marker.bindPopup(popupContent).openPopup();

        loadComments(monument.name);

        markers.push(marker);
    }

    function loadComments(monumentName) {
        fetch(`get_comments.php?monument=${encodeURIComponent(monumentName)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.text().then(text => {
                    try {
                        return JSON.parse(text);
                    } catch (error) {
                        console.error('Error parsing JSON:', text);
                        throw error;
                    }
                });
            })
            .then(comments => {
                const commentSection = document.getElementById(`comment-section-${monumentName}`);
                if (comments.length > 0) {
                    comments.forEach(comment => {
                        const commentDiv = document.createElement('div');
                        commentDiv.classList.add('comment');
                        commentDiv.innerHTML = `
                            <p><strong>User ${comment.idUser}:</strong> ${comment.commentaire}</p>
                            <p><em>${comment.dateCommentaire}</em></p>
                        `;
                        commentSection.appendChild(commentDiv);
                    });
                } else {
                    commentSection.innerHTML = '<p>No comments yet.</p>';
                }
            })
            .catch(error => console.error('Error loading comments:', error));
    }
    
    function fetchComments(monumentName) {
        fetch(`fetch_comments.php?monument=${encodeURIComponent(monumentName)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.text().then(text => {
                    try {
                        return JSON.parse(text);
                    } catch (error) {
                        console.error('Error parsing JSON:', text);
                        throw error;
                    }
                });
            })
            .then(comments => {
                const commentsList = document.getElementById('comments-list');
                commentsList.innerHTML = '';
                comments.forEach(comment => {
                    const listItem = document.createElement('li');
                    listItem.textContent = comment.commentaire;
                    commentsList.appendChild(listItem);
                });
            })
            .catch(error => console.error('Error fetching comments:', error));
    }
    
    function postComment(monumentName, userId, commentText) {
        fetch('post_comment.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ monumentName, userId, commentText })
        })
        .then(response => {
            return response.text().then(text => {
                try {
                    return JSON.parse(text);
                } catch (error) {
                    console.error('Error parsing JSON:', text);
                    throw error;
                }
            });
        })
        .then(data => {
            if (data.success) {
                fetchComments(monumentName);
                document.getElementById('new-comment').value = '';
            } else {
                console.error('Error posting comment:', data.error);
            }
        })
        .catch(error => console.error('Error posting comment:', error));
    }
    

});
