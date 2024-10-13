// CREATE SEARCHER
const searcherMobile = document.querySelector(".searcher__mobile");
const searcherMiddle = document.querySelector(".searcher__middle");
const searcherDesktop = document.querySelector(".searcher__desktop");

const dropdownAttributes = ["purpose", "localisation", "producent", "condition"];
const dropdownElements = [purpose, localisation, producent, condition];

// CREATE VALUES FOR SLIDER
let sliderOne;
let sliderTwo;
let sliderThree;
let sliderFour;

let displayValOne;
let displayValTwo;
let displayValThree;
let displayValFour;

const yearMin = 1990;
const yearMax = 2024;

const priceMin = 1000;
const priceMax = 10000;

const minGap = 3;
const minGap2 = 600;

function slideOne() {
    if (parseInt(sliderTwo.value) - parseInt(sliderOne.value) <= minGap) {
        sliderOne.value = parseInt(sliderTwo.value) - minGap;
    }
    displayValOne.textContent = sliderOne.value;
}

function slideTwo() {
    if (parseInt(sliderTwo.value) - parseInt(sliderOne.value) <= minGap) {
        sliderTwo.value = parseInt(sliderOne.value) + minGap;
    }
    displayValTwo.textContent = sliderTwo.value;
}

function slideThree() {
    if (parseInt(sliderFour.value) - parseInt(sliderThree.value) <= minGap2) {
        sliderThree.value = parseInt(sliderFour.value) - minGap2;
    }
    displayValThree.textContent = sliderThree.value;
}

function slideFour() {
    if (parseInt(sliderFour.value) - parseInt(sliderThree.value) <= minGap2) {
        sliderFour.value = parseInt(sliderThree.value) + minGap2;
    }
    displayValFour.textContent = sliderFour.value;
}

function capitalizeFirstLetter(attribute) {
    if (attribute.length == 0) return attribute;
    return attribute.charAt(0).toUpperCase() + attribute.slice(1);
}

function createSlider(
    nameOfSlider,
    rangeLower,
    rangeHigher,
    valueMin,
    valueMax,
    functionFirst,
    functionSecond,
    spanIDOne,
    spanIDTwo
) {
    const sliderMenuContainer = document.createElement("div");
    sliderMenuContainer.className = "flex-center-column";

    const labelFor = document.createElement("label");
    labelFor.innerHTML = capitalizeFirstLetter(nameOfSlider);
    labelFor.className = "searcher__label";
    labelFor.setAttribute("for", rangeLower);

    const sliderSecondContainer = document.createElement("div");
    sliderSecondContainer.className = "searcher__slider-container";

    const inputOne = document.createElement("input");
    inputOne.type = "range";
    inputOne.min = valueMin;
    inputOne.max = valueMax;
    inputOne.name = rangeLower;
    inputOne.setAttribute("id", rangeLower);
    inputOne.setAttribute("oninput", functionFirst);

    const inputTwo = document.createElement("input");
    inputTwo.type = "range";
    inputTwo.min = valueMin;
    inputTwo.max = valueMax;
    inputTwo.name = rangeHigher;
    inputTwo.setAttribute("id", rangeHigher);
    inputTwo.setAttribute("oninput", functionSecond);

    const values = document.createElement("div");
    values.className = "searcher__values flex-center-row";

    const rangeOneSpan = document.createElement("span");
    rangeOneSpan.innerHTML = valueMin;
    rangeOneSpan.id = spanIDOne;

    const rangeTwoSpan = document.createElement("span");
    rangeTwoSpan.innerHTML = valueMax;
    rangeTwoSpan.id = spanIDTwo;

    values.appendChild(rangeOneSpan);
    values.appendChild(rangeTwoSpan);

    sliderSecondContainer.appendChild(inputOne);
    sliderSecondContainer.appendChild(inputTwo);

    sliderMenuContainer.appendChild(labelFor);
    sliderMenuContainer.appendChild(sliderSecondContainer);
    sliderMenuContainer.appendChild(values);

    return sliderMenuContainer;
}

function createDropdown(element, countElements) {
    const dropDownMenuContainer = document.createElement("div");
    dropDownMenuContainer.className = "flex-center-column";

    const labelFor = document.createElement("label");
    labelFor.innerHTML = capitalizeFirstLetter(element);
    labelFor.className = "searcher__label";
    labelFor.setAttribute("for", element);

    const dropdown = document.createElement("select");
    dropdown.id = element;
    dropdown.name = element;
    dropdown.className = "searcher__dropdown";

    let i = 0;
    dropdownElements[countElements].forEach((element) => {
        const createOption = document.createElement("option");
        createOption.innerHTML = element.value;
        if (i == 0) {
            createOption.defaultSelected = true;
        }
        createOption.value = element.value;
        dropdown.appendChild(createOption);
        i++;
    });

    dropDownMenuContainer.appendChild(labelFor);
    dropDownMenuContainer.appendChild(dropdown);

    return dropDownMenuContainer;
}

function createSearcherMobile() {
    searcherMobile.innerHTML = "";

    let countElements = 0;
    dropdownAttributes.forEach((element) => {
        const ourDropdown = createDropdown(element, countElements);

        searcherMobile.appendChild(ourDropdown);

        countElements++;
    });

    const sliderYears = createSlider(
        "Year:",
        "slider-1",
        "slider-2",
        1990,
        2024,
        "slideOne()",
        "slideTwo()",
        "range1",
        "range2"
    );

    const sliderPrice = createSlider(
        "Price (zł):",
        "slider-3",
        "slider-4",
        1000,
        10000,
        "slideThree()",
        "slideFour()",
        "range3",
        "range4"
    );

    searcherMobile.appendChild(sliderYears);
    searcherMobile.appendChild(sliderPrice);
}

function createTableMiddleDesktop(sliderOnePosition, sliderTwoPosition) {
    const elementsForLoop = [];

    let countElements = 0;
    dropdownAttributes.forEach((element) => {
        const ourDropdown = createDropdown(element, countElements);

        elementsForLoop.push(ourDropdown);

        countElements++;
    });

    const sliderYears = createSlider(
        "Year:",
        "slider-1",
        "slider-2",
        1990,
        2024,
        "slideOne()",
        "slideTwo()",
        "range1",
        "range2"
    );

    const sliderPrice = createSlider(
        "Price (zł):",
        "slider-3",
        "slider-4",
        1000,
        10000,
        "slideThree()",
        "slideFour()",
        "range3",
        "range4"
    );

    elementsForLoop.splice(sliderOnePosition, 0, sliderYears);
    elementsForLoop.splice(sliderTwoPosition, 0, sliderPrice);

    return elementsForLoop;
}

function createSearcherMiddle() {
    searcherMiddle.innerHTML = "";

    const elementsForLoop = createTableMiddleDesktop(2, 5);

    for (i = 0; i < 2; i++) {
        const menuColumnSliders = document.createElement("div");
        menuColumnSliders.className = "searcher__middle flex-center-column";

        if (i == 0) {
            for (j = 0; j < 3; j++) {
                menuColumnSliders.appendChild(elementsForLoop[j]);
            }
        } else if (i == 1) {
            for (j = 3; j < 6; j++) {
                menuColumnSliders.appendChild(elementsForLoop[j]);
            }
        }

        searcherMiddle.appendChild(menuColumnSliders);
    }
}

function createSearcherDesktop() {
    searcherDesktop.innerHTML = "";

    const elementsForLoop = createTableMiddleDesktop(4, 5);

    for (i = 0; i < 3; i++) {
        const menuColumnSliders = document.createElement("div");
        menuColumnSliders.className = "searcher__column flex-center-column";

        if (i == 0) {
            for (j = 0; j < 2; j++) {
                menuColumnSliders.appendChild(elementsForLoop[j]);
            }
        } else if (i == 1) {
            for (j = 2; j < 4; j++) {
                menuColumnSliders.appendChild(elementsForLoop[j]);
            }
        } else if (i == 2) {
            for (j = 4; j < 6; j++) {
                menuColumnSliders.appendChild(elementsForLoop[j]);
            }
        }
        searcherDesktop.appendChild(menuColumnSliders);
    }
}
