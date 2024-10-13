// results -> gallery for searcher
// slider -> gallery at the top

// Onload and breakpoints
const sliderBreakpointsObject = {
    unreachableDesktop: {
        width: Infinity,
        resultsBikesPerSlide: 10,
        sliderBikesPerSlide: 5,
        type: "desktop",
    },
    desktopLarge: {
        width: 1920,
        resultsBikesPerSlide: 10,
        sliderBikesPerSlide: 5,
        type: "desktop",
    },
    desktopMedium: {
        width: 1440,
        resultsBikesPerSlide: 8,
        sliderBikesPerSlide: 4,
        type: "desktop",
    },
    desktopSmall: {
        width: 1024,
        resultsBikesPerSlide: 8,
        sliderBikesPerSlide: 4,
        type: "desktop",
    },
    middle: {
        width: 768,
        resultsBikesPerSlide: 6,
        sliderBikesPerSlide: 3,
        type: "middle",
    },
    mobile: {
        width: 360,
        resultsBikesPerSlide: 4,
        sliderBikesPerSlide: 2,
        type: "mobile",
    },
};

let lastBreakpointKey;
let upperBreakpointKey;

let currentPage;
let resultsPages;

let count = 1;

function createSearcher() {
    if (sliderBreakpointsObject[lastBreakpointKey].type === "desktop") {
        createSearcherDesktop();
    } else if (sliderBreakpointsObject[lastBreakpointKey].type === "middle") {
        createSearcherMiddle();
    } else if (sliderBreakpointsObject[lastBreakpointKey].type === "mobile") {
        createSearcherMobile();
    }

    sliderOne = document.getElementById("slider-1");
    sliderTwo = document.getElementById("slider-2");
    sliderThree = document.getElementById("slider-3");
    sliderFour = document.getElementById("slider-4");

    displayValOne = document.getElementById("range1");
    displayValTwo = document.getElementById("range2");
    displayValThree = document.getElementById("range3");
    displayValFour = document.getElementById("range4");

    sliderOne.value = yearMin;
    sliderTwo.value = yearMax;
    sliderThree.value = priceMin;
    sliderFour.value = priceMax;
}

// trzeba powtórzyć promise
// trzeba powtórzyć sobie funkcje tablic

let sliderPage;
let sliderPages;

function sliderRowsColumns(key, size) {
    if (size > sliderBreakpointsObject[key].sliderBikesPerSlide) {
        document.documentElement.style.setProperty(
            "--slider-columns",
            sliderBreakpointsObject[key].sliderBikesPerSlide
        );
    } else {
        document.documentElement.style.setProperty("--slider-columns", size);
    }
}

function resultsRowsColumns(key, size) {
    if (size > sliderBreakpointsObject[key].sliderBikesPerSlide) {
        document.documentElement.style.setProperty("--rows", 2);
        document.documentElement.style.setProperty(
            "--results-columns",
            sliderBreakpointsObject[key].sliderBikesPerSlide
        );
    } else {
        document.documentElement.style.setProperty("--results-columns", size);
    }
}

function galleryFindBikesImage(images, bike) {
    for (let i = 0; i < images.length; i++) {
        if (images[i].bike === bike.id) {
            const imageName = images[i].image;
            return imageName;
        }
    }
}

function galleryAddBike(bike, images) {
    const link = document.createElement("a");
    link.className = "clean-links";
    link.href = "/showBike/" + bike.id;

    const container = document.createElement("div");
    container.className = "bike-container flex-center-column";

    const image = document.createElement("img");
    image.className = "bike-container__image";

    const imageName = galleryFindBikesImage(images, bike);

    image.src = "/images/" + imageName;
    image.alt = "Picture of a bike.";

    const price = document.createElement("div");
    price.className = "bike-container__price";
    price.innerHTML = bike.price + "zł";

    const name = document.createElement("div");
    name.className = "bike-container__p";
    name.innerHTML = bike.name;

    const bikeLocalisation = document.createElement("div");
    bikeLocalisation.className = "bike-container__p";
    bikeLocalisation.innerHTML =
        "Localisation: " + localisation[bike.localisation - 1].value;

    container.appendChild(image);
    container.appendChild(price);
    container.appendChild(name);
    container.appendChild(bikeLocalisation);

    link.appendChild(container);

    return link;
}

function galleryUpdate(
    i,
    bikesPerSlide,
    bikes,
    images,
    container,
    gallery,
    galleryClass
) {
    if (i % bikesPerSlide === 0) {
        if (i > 0) {
            container.appendChild(gallery);
        }
        gallery = document.createElement("div");
        gallery.className = galleryClass;
    }
    const bikeContainer = galleryAddBike(bikes[i], images);
    gallery.appendChild(bikeContainer);
    return gallery;
}

function galleryCreate(
    resultsBikePerSlide,
    resultsBikes,
    resultsImages,
    resultsContainer,
    sliderBikePerSlide,
    sliderBikes,
    sliderImages,
    sliderContainer,
    website
) {
    let resultsGallery;
    let sliderGallery;

    // Results gallery
    
    if(website === "offer" || website === "results") {
        if (resultsBikes.length > 0) {
            for (let i = 0; i < resultsBikes.length; i++) {
                resultsGallery = galleryUpdate(
                    i,
                    resultsBikePerSlide,
                    resultsBikes,
                    resultsImages,
                    resultsContainer,
                    resultsGallery,
                    "results__bikes"
                );
            }
            resultsContainer.appendChild(resultsGallery);
        }
    }

    // Slider gallery
    for (let i = 0; i < sliderBikes.length; i++) {
        sliderGallery = galleryUpdate(
            i,
            sliderBikePerSlide,
            sliderBikes,
            sliderImages,
            sliderContainer,
            sliderGallery,
            "slider__bikes"
        );
    }
    sliderContainer.appendChild(sliderGallery);

    return [resultsGallery, sliderGallery];
}

function initializeGalleries() {
    const currentWidth = window.innerWidth;

    currentPage = 1;
    sliderPage = 2;

    const resultsScrollbar = document.querySelector(".results__scrollbar");
    const resultsContainer = document.querySelector(".results__container");

    if (website === "offer" || website === "results") {
        resultsScrollbar.scrollLeft = 0;
        resultsContainer.innerHTML = "";
    }

    const sliderScrollbar = document.querySelector(".slider__scrollbar");
    sliderScrollbar.scrollLeft = 0;
    const sliderContainer = document.querySelector(".slider__container");
    sliderContainer.innerHTML = "";

    let resultsAmount;
    let sliderAmount;
    let lastKey;

    for (const key in sliderBreakpointsObject) {
        if (lastKey === undefined) {
            lastKey = key;
        }

        if (currentWidth >= sliderBreakpointsObject[key].width) {
            if (website === "results") {
                resultsPages = Math.ceil(
                    bikeResult.length /
                        sliderBreakpointsObject[key].resultsBikesPerSlide
                );
                resultsRowsColumns(key, bikeResult.length);
            } else {
                resultsPages = Math.ceil(
                    bikes.length /
                        sliderBreakpointsObject[key].resultsBikesPerSlide
                );
                resultsRowsColumns(key, bikes.length);
            }

            sliderPages =
                Math.ceil(
                    bikes.length /
                        sliderBreakpointsObject[key].sliderBikesPerSlide
                ) + 2;

            sliderRowsColumns(key, bikes.length);

            document.documentElement.style.setProperty(
                "--results-slides",
                resultsPages
            );
            document.documentElement.style.setProperty(
                "--slider-slides",
                sliderPages
            );

            lastBreakpointKey = key;
            upperBreakpointKey = lastKey;
            resultsAmount = sliderBreakpointsObject[key].resultsBikesPerSlide;
            sliderAmount = sliderBreakpointsObject[key].sliderBikesPerSlide;
            break;
        }
        lastKey = key;
    }

    let galleries;

    if (website === "results") {
        galleries = galleryCreate(
            resultsAmount,
            bikeResult,
            imagesResult,
            resultsContainer,
            sliderAmount,
            bikes,
            images,
            sliderContainer,
            website
        );
    }
    else {
        galleries = galleryCreate(
            resultsAmount,
            bikes,
            images,
            resultsContainer,
            sliderAmount,
            bikes,
            images,
            sliderContainer,
            website
        );
    }

    // Results gallery
    if (galleries[0] !== undefined && galleries[0] !== null) {
        if (website === "offer" || website === "results") {
            const resultsGallery = galleries[0];

            resultsContainer.appendChild(resultsGallery);

            const resultSection = document.querySelector("#results");

            const paginator = document.querySelector(".paginator");

            const counter = document.querySelector(".counter");
            counter.innerHTML =
                "PAGE NUMBER " + currentPage + " OUT OF " + resultsPages;

            paginator.appendChild(counter);

            resultSection.appendChild(paginator);
        }
    } else if(website === "results") {
        const resultsSection = document.querySelector("#results");
        resultsSection.innerHTML = "";

        const noResultsText = document.createElement("p");
        noResultsText.style.marginBottom = "18px";
        noResultsText.style.fontSize = "24px";
        noResultsText.style.textAlign = "center";
        noResultsText.style.fontWeight = "bold";
        noResultsText.innerHTML =
            "There is no bikes with this specyfication, try again!";

        resultsSection.appendChild(noResultsText);
    }

    // Slider gallery
    const sliderGallery = galleries[1];

    sliderContainer.appendChild(sliderGallery);

    let firstContainer = sliderContainer.firstChild.cloneNode(true);
    let lastContainer = sliderContainer.lastChild.cloneNode(true);

    sliderContainer.appendChild(firstContainer);
    sliderContainer.prepend(lastContainer);

    const scrollAmount = sliderScrollbar.clientWidth;
    sliderScrollbar.scrollBy({
        left: scrollAmount,
        behavior: "instant",
    });

    return lastBreakpointKey;
}

function sliderListeners() {
    const sliderPaginatorLeft = document.querySelector(
        "#slider__paginator-left"
    );
    const sliderPaginatorRight = document.querySelector(
        "#slider__paginator-right"
    );

    const sliderScrollbar = document.querySelector(".slider__scrollbar");

    sliderPage = 2;

    const timeout = 500;

    let sliderFlag = true;

    sliderPaginatorRight.addEventListener("click", () => {
        if (sliderFlag) {
            const scrollAmount = sliderScrollbar.clientWidth;
            sliderScrollbar.scrollBy({
                left: scrollAmount,
                behavior: "smooth",
            });
            sliderPage++;
            sliderFlag = false;

            if (sliderPages > 3 && sliderPage === sliderPages) {
                setTimeout(function () {
                    sliderScrollbar.scrollTo({
                        left: scrollAmount,
                        behavior: "instant",
                    });
                }, timeout);
                sliderPage = 2;
            }

            setTimeout(function () {
                sliderFlag = true;
            }, timeout);
        }
    });

    sliderPaginatorLeft.addEventListener("click", () => {
        if (sliderFlag) {
            const scrollAmount = sliderScrollbar.clientWidth;
            sliderScrollbar.scrollBy({
                left: -scrollAmount,
                behavior: "smooth",
            });
            sliderPage--;
            sliderFlag = false;

            if (sliderPages > 3 && sliderPage === 1) {
                setTimeout(function () {
                    sliderScrollbar.scrollTo({
                        left: scrollAmount * (sliderPages - 2),
                        behavior: "instant",
                    });
                }, timeout);
                sliderPage = sliderPages - 1;
            }

            setTimeout(function () {
                sliderFlag = true;
            }, timeout);
        }
    });
}

function initializePaginator() {
    currentPage = 1;

    const resultsSection = document.querySelector("#results");

    const resultsScrollbar = document.querySelector(".results__scrollbar");

    const paginator = document.querySelector(".paginator");

    const counter = document.querySelector(".counter");
    counter.innerHTML =
        "PAGE NUMBER " + currentPage + " OUT OF " + resultsPages;

    const slideRight = document.querySelector("#results__paginator-right");
    const slideLeft = document.querySelector("#results__paginator-left");

    slideRight.addEventListener("click", () => {
        if (currentPage !== resultsPages) {
            const scrollAmount = resultsScrollbar.clientWidth;
            resultsScrollbar.scrollBy({
                left: scrollAmount,
                behavior: "smooth",
            });
            currentPage++;
            counter.innerHTML =
                "PAGE NUMBER " + currentPage + " OUT OF " + resultsPages;
        }
    });

    slideLeft.addEventListener("click", () => {
        if (currentPage !== 1) {
            const scrollAmount = resultsScrollbar.clientWidth;
            resultsScrollbar.scrollBy({
                left: -scrollAmount,
                behavior: "smooth",
            });
            currentPage--;
            counter.innerHTML =
                "PAGE NUMBER " + currentPage + " OUT OF " + resultsPages;
        }
    });

    paginator.appendChild(counter);

    resultsSection.appendChild(paginator);
}

// Onload and resize
window.onload = function () {
    initializeGalleries();
    if (website === "offer" || website === "results") {
        createSearcher();
        initializePaginator();
        pdfDownloadNote();
    }
    sliderListeners();
    changeFooter();
};

window.addEventListener("resize", () => {
    const currentWidth = window.innerWidth;

    if (
        sliderBreakpointsObject[lastBreakpointKey].width < currentWidth &&
        currentWidth < sliderBreakpointsObject[upperBreakpointKey].width
    ) {
        return;
    } else {
        initializeGalleries();
        if (website === "offer" || website === "results") {
            createSearcher();
        }
    }
    changeFooter();
});
