function resizeAllImages() {
    const allImages = document.querySelectorAll("img");
    allImages.forEach(function(img) {
        img.style.width = "100px";
        img.style.height = "100px";
    });
}

resizeAllImages();
