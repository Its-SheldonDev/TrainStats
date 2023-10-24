// Attente que la page soit entièrement chargée
window.addEventListener("load", () => {
    // Suppréssion de l'élément de chargement
    const loaderContainer = document.querySelector(".loading-container");
    loaderContainer.classList.add("animate"); // Classe "animate" pour déclencher l'animation
    setTimeout(() => {
        loaderContainer.style.display = "none";
    }, 2000); // Délai (en millisecondes)
});