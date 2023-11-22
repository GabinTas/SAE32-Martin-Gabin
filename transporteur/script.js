document.addEventListener('DOMContentLoaded', function () {
    // Exemple de données des produits (à remplacer par les données de votre base de données)
    const products = [
        { id: 1, name: "Objet 1", address: "Paris" },
        { id: 2, name: "Objet 2", address: "Madrid" },
        // ... Ajoutez d'autres produits ici
    ];

    // Fonction pour afficher la liste des produits
    function displayProductList() {
        const productList = document.getElementById("product-list");

        products.forEach(product => {
            const productItem = document.createElement("div");
            productItem.classList.add("product-item");
            productItem.textContent = product.name;
            productItem.dataset.id = product.id;
            productItem.dataset.name = product.name;
            productItem.dataset.address = product.address;
            productItem.addEventListener("click", () => showMap(product));
            productList.appendChild(productItem);
        });
    }

    // Fonction pour afficher la carte avec l'adresse du produit sélectionné
    function showMap(product) {
        const mapContainer = document.getElementById("map-container");
        const map = document.getElementById("map");

        // Nettoyage du contenu précédent de la carte
        map.innerHTML = "";

        // Ajout du bouton de fermeture
        const closeButton = document.createElement("button");
        closeButton.id = "close-map";
        closeButton.textContent = "Fermer la carte";
        closeButton.addEventListener("click", () => hideMap(mapContainer));

        // Ajout du bouton de fermeture et du contenu de la carte
        map.appendChild(closeButton);
        displayLeafletMap(map, product.address);

        mapContainer.style.display = "flex";
    }

    // Fonction pour masquer la carte
    function hideMap(mapContainer) {
        mapContainer.style.display = "none";
    }

    // Fonction pour afficher la carte Leaflet
    function displayLeafletMap(mapElement, address) {
        const mymap = L.map(mapElement).setView([0, 0], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(mymap);

        // Utilisation du service de géocodage Nominatim
        const geocoder = L.Control.Geocoder.nominatim();
        geocoder.geocode(address, (results) => {
            if (results && results.length > 0) {
                const latlng = results[0].center;
                const marker = L.marker(latlng).addTo(mymap);
                marker.bindPopup(`<p>Adresse de livraison : ${address}</p>`).openPopup();
                mymap.setView(latlng, 13); // Ajustez le niveau de zoom (dans cet exemple, 13)
            } else {
                console.error("Erreur de géocodage pour l'adresse : " + address);
            }
        });
    }



    // Appel de la fonction pour afficher la liste des produits
    displayProductList();
});
