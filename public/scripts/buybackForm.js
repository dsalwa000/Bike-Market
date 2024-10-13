function createNewInput(image, inputName) {
    const formInput = document.createElement("input");
    formInput.name = inputName;
    formInput.setAttribute("value", image);
    formInput.hidden = true;
    formInput.required = true;
    return formInput;
}

const confirmMailForm = document.querySelector(".confirm-mail__form");

// Catch form
confirmMailForm.appendChild(createNewInput(form, "formInput"));

// Catch images
const imagesLimit = 5;
for (let i = 0; i < bikeImages.length; i++) {
    if (i === imagesLimit) {
        break;
    }

    if (form[i] === undefined) {
        break;
    } else {
        confirmMailForm.appendChild(
            createNewInput(bikeImages[i], "bikeImage" + i)
        );
    }
}










