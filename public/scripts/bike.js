const bikeTable = document.querySelector(".bike__table");

const bikeData = [
    '<i class="bi bi-bicycle"></i>',
    "Bike name",
    thisBike[0].name,
    '<i class="bi bi-tag"></i>',
    "Price tag (zł)",
    thisBike[0].price,
    '<i class="bi bi-building"></i>',
    "Producent",
    thisProducent[0].value,
    '<i class="bi bi-calendar"></i>',
    "Year",
    thisBike[0].year,
    '<i class="bi bi-geo"></i>',
    "Localisation",
    thisLocalisation[0].value,
    '<i class="bi bi-telephone"></i>',
    "Phone",
    thisBike[0].phone,
];

function createTable() {
    let j = 0;
    const rowsAmount = 6;
    for (i = 0; i < 6; i++) {
        const row = document.createElement("tr");

        row.className =
            i % 2 === 1 ? "bike__table-white-row" : "bike__table-shade-row";

        const newLimit = j + 3;
        let innerCounter = 0;
        while (newLimit > j) {
            const data = document.createElement("td");
            data.classList =
                innerCounter === 0 ? "bike__table-icons" : "bike__table-text";
            data.innerHTML = bikeData[j];
            row.appendChild(data);

            j++;
            innerCounter++;
        }

        bikeTable.appendChild(row);
    }
}

let counter = 1;

const timeout = 300;

const bikeAmount = bikeImagesList.length;

const bikeSlider = document.querySelector(".bike__slider");

const bikeImages = document.querySelector(".bike__images");

const page = document.querySelector(".bike__counter");

function initializePhoto(photo) {
    const image = document.createElement("img");
    image.classList = "bike__image";
    image.src = "/images/" + photo;
    image.alt = "Picture of a bike.";

    return image;
}

function initializeSlider() {
    counter = 1;
    bikeSlider.innerHTML = "";

    for (let i = 0; i < bikeAmount; i++) {
        const image = initializePhoto(bikeImagesList[0].image);

        bikeSlider.appendChild(image);
    }

    bikeImages.scrollTo({ left: 0, behavior: "instant" });

    page.innerHTML = "PICTURE " + counter + " OUT OF " + bikeAmount;
}

function slideTo(counter, flag) {
    page.innerHTML = "PICTURE " + counter + " OUT OF " + bikeAmount;
    const slide = bikeImages.clientWidth * (counter - 1);
    bikeImages.scrollTo({ left: slide, behavior: "smooth" });
    flag = false;
    setTimeout(() => {
        flag = true;
    }, timeout);
}

function sliderListeners() {
    const bikeSlideLeft = document.querySelector(".bike__slide-left");

    const bikeSlideRight = document.querySelector(".bike__slide-right");

    let flag = true;

    bikeSlideLeft.addEventListener("click", () => {
        if (flag) {
            if (counter > 1) {
                counter--;
                slideTo(counter, flag);
            }
        }
    });

    bikeSlideRight.addEventListener("click", () => {
        if (flag) {
            if (bikeAmount > 1) {
                if (counter < bikeAmount) {
                    counter++;
                    slideTo(counter, flag);
                }
            }
        }
    });
}

const sliderBreakpoints = [1920, 1440, 1024, 768, 360];
let lastBreakpointIndex;
let higherBreakpointIndex;

function defineBreakpoint() {
    const currentWidth = window.innerWidth;

    for (let i = 0; i < sliderBreakpoints.length; i++) {
        if (currentWidth > sliderBreakpoints[i]) {
            lastBreakpointIndex = i;
            higherBreakpointIndex = i + 1;
            break;
        }
    }
}

function rowOrColumnFlex() {
    const sliderFlex = document.querySelector(".bike__container");

    const mobileBreakpoint = 4;

    if (lastBreakpointIndex === mobileBreakpoint) {
        sliderFlex.style.flexDirection = "column";
    } else {
        sliderFlex.style.flexDirection = "row";
    }
}

window.onload = function () {
    pdfDownloadNote();
    createTable();
    initializeSlider();
    sliderListeners();
    defineBreakpoint();
    rowOrColumnFlex();
    changeFooter();
};

window.addEventListener("resize", function () {
    const currentWidth = window.innerWidth;

    if (
        sliderBreakpoints[lastBreakpointIndex] < currentWidth &&
        currentWidth < sliderBreakpoints[higherBreakpointIndex]
    ) {
        return;
    } else {
        initializeSlider();
        defineBreakpoint();
        rowOrColumnFlex();
        changeFooter();
    }
});
