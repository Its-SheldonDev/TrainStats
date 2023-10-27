window.addEventListener("load", () => {
    const loaderContainer = document.querySelector(".loading-container");
    loaderContainer.classList.add("animate");
    setTimeout(() => {
        loaderContainer.style.display = "none";
    }, 2000);
});