const sendForm = document.querySelector("#sendForm");
const formSpan = document.querySelector(".form__send-form");

const bikeImages = document.querySelector("#bikeImages");
const formImages = document.querySelector(".form__images");

const bikeLimit = 5;

sendForm.addEventListener("change", function (event) {
    const fileName = event.target.files[0].name;
    formSpan.innerHTML = "Choosen form: " + fileName;
});

bikeImages.addEventListener("change", function (event) {
    let photosName = "";
    for (let i = 0; i < event.target.files.length; i++) {
        if (i === bikeLimit) break;
        const fileName = event.target.files[i].name;
        photosName += fileName + ", ";
    }
    formImages.innerHTML = "Choosen bike's images: " + photosName;
});

