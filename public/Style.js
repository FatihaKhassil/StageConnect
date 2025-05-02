window.addEventListener("scroll", function() {
    var menu_bar = document.querySelector(".menu_bar"); // Vérifie la bonne classe
    if (window.scrollY > 50) {  
        menu_bar.style.backgroundColor = "white";  // Change le fond en blanc
        menu_bar.style.boxShadow = "0px 4px 10px rgba(0, 0, 0, 0.1)"; // Ajoute une ombre
    } else {
        menu_bar.style.backgroundColor = "transparent"; // Reste transparent en haut
        menu_bar.style.boxShadow = "none"; // Supprime l'ombre
    }
});
