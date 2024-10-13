function pdfDownloadNote() {
    const pdfNote = document.querySelector("#pdf__note");
    const pdfNoteIcon = document.querySelector(".pdf__note-icon");
    const pdfLink = document.querySelector(".pdf__link");

    pdfLink.addEventListener("click", () => {
        pdfNote.style.display = "flex";
    });

    pdfNoteIcon.addEventListener("click", () => {
        pdfNote.style.display = "none";
    });
}

