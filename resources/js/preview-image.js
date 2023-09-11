const inputImage = document.getElementById("image");
const imagePreview = document.getElementById("preview");
const placeholder = "https://marcolanci.it/utils/placeholder.jpg";

let url = null;

inputImage.addEventListener("input", () => {
    if (inputImage.files[0]) {
        const file = inputImage.files[0];
        url = URL.createObjectURL(file);
        imagePreview.src = url;
    } else {
        imagePreview.src = placeholder;
    }
});

window.addEventListener("beforeunload", () => {
    if (url) URL.revokeObjectURL(url);
});
