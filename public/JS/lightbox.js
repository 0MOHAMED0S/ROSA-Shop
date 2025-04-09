document.addEventListener("DOMContentLoaded", function () {
    const productImg = document.getElementById("product-img");
    const lightbox = document.getElementById("lightbox");
    const lightboxImg = document.getElementById("lightbox-img");
    const closeLightbox = document.getElementById("close-lightbox");

    productImg.addEventListener("click", () => {
        lightboxImg.src = productImg.src;
        lightbox.classList.remove("hidden");
    });

    closeLightbox.addEventListener("click", () => {
        lightbox.classList.add("hidden");
    });

    lightbox.addEventListener("click", (e) => {
        if (e.target === lightbox) {
            lightbox.classList.add("hidden");
        }
    });
});
