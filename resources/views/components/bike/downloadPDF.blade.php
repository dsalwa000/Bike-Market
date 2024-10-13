{{-- PDF --}}
<section id="pdf">
    <a href="/showRower/download/{{ $bike }}" class="pdf__link">
        <div class="flex-center-column pdf__container pdf--mobile">
            <div class="pdf__download flex-center-row">
                <p class="pdf__text">Clik and download this bike's offer on pdf -></p>
                <img class="pdf__image" src={{ asset('/images/downloadPDF.png') }}>
            </div>
        </div>
        <div class="flex-center-column pdf__container pdf--desktop">
            <div class="pdf__download flex-center-column">
                <p class="pdf__text">Clik and download this bike's offer on pdf: </p>
                <img class="pdf__image" src={{ asset('/images/downloadPDF.png') }}>
            </div>
        </div>
    </a>

    <aside id="pdf__note">
        <div class="pdf__note-container">
            <p class="pdf__note-text">We are working on your PDF, it may take a while. Please wait a moment.</p>
            <i class="pdf__note-icon bi bi-x-lg"></i>
        </div>
    </aside>
</section>

<section id="call-us">
    <div class="call-us__container call-us__below flex-center-column">
        <p class="call-us__paragrph">If you have any question call:</p>
        <p class="call-us__phone-number">+48 000 000 000</p>
        <p class="call-us__email">You can mail us at: bike@mail.com</p>
    </div>

    <div class="call-us__container call-us__inline flex-center-column">
        <p class="call-us__paragrph">If you have any question call: +48 000 000 000</p>
        <p class="call-us__email">You can mail us at: bike@mail.com</p>
    </div>
</section>
{{-- End PDF --}}