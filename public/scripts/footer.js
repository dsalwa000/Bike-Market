function footerLogic(
    lastBreakpointKey,
    lastBreakpointIndex,
    footer,
    footerContainer,
    footerLinksContainer
) {
    if (
        lastBreakpointKey === "middle" ||
        lastBreakpointKey === "mobile" ||
        lastBreakpointIndex > 2
    ) {
        footer.classList.remove("flex-center-column");

        footerContainer.style.flexDirection = "column";
        footerContainer.style.justifyContent = "";
        footerContainer.style.width = "";

        footerLinksContainer.classList.remove("flex-center-row");
        footerLinksContainer.style.borderTop = "1px #bcc1ca solid";
        footerLinksContainer.style.justifyContent = "";
    } else {
        footer.classList.add("flex-center-column");

        footerContainer.style.flexDirection = "row";
        footerContainer.style.justifyContent = "space-between";
        footerContainer.style.width = "var(--wanted-width)";

        footerLinksContainer.classList.add("flex-center-row");
        footerLinksContainer.style.borderTop = "";
        footerLinksContainer.style.justifyContent = "space-evenly";
    }
}

function changeFooter() {
    const footer = document.querySelector("#footer");
    const footerContainer = document.querySelector(".footer__container");
    const footerLinksContainer = document.querySelector(
        ".footer__links-container"
    );

    if (typeof lastBreakpointIndex === "undefined") {
        const lastBreakpointIndex = undefined;
        footerLogic(
            lastBreakpointKey,
            lastBreakpointIndex,
            footer,
            footerContainer,
            footerLinksContainer
        );
    } else if (typeof lastBreakpointKey === "undefined") {
        const lastBreakpointKey = undefined;
        footerLogic(
            lastBreakpointKey,
            lastBreakpointIndex,
            footer,
            footerContainer,
            footerLinksContainer
        );
    }
}
