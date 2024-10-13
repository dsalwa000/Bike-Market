{{-- Searcher --}}
<section id="searcher">
    <div class="searcher__text searcher--text-mobile flex-center-row">
        <p class="searcher__paragraph">Searcher</p>
    </div>

    <div class="searcher__text searcher--text-desktop flex-center-row">
        <p class="searcher__paragraph">Or use a professional searcher:</p>
    </div>

    <form action="/results" method="post">
        @csrf
        {{-- Searcher mobile --}}
        <div class="searcher__mobile flex-center-column">
            {{-- Code in JS --}}
        </div>
        {{-- End Searcher mobile --}}


        {{-- Searcher middle --}}
        <div class="searcher__middle-container flex-center-column">
            <div class="searcher__middle searcher--width flex-center-row">
                {{-- Code in JS --}}
            </div>
        </div>
        {{-- End Searcher middle --}}


        {{-- Searcher desktop --}}
        <div class="searcher__desktop-container flex-center-column">
            <div class="searcher__desktop searcher--width flex-center-row">
                {{-- Code in JS --}}
            </div>
        </div>
        {{-- End Searcher desktop --}}


        {{-- Search button --}}
        <div class="searcher__button-container flex-center-row border-top-bottom">
            <button type="submit" class="searcher__button">Search</button>
        </div>
        {{-- End Search button --}}
    </form>
</section>
{{-- End Searcher --}}

{{-- Results Text --}}
<p id="resultText" class="results-text">Search results:</p>

{{-- Results --}}
<section id="results" class="flex-center-column">
    <div class="results">

        <div id="results__paginator-left" class="paginator-left flex-center-column">
            <i class="bi bi-arrow-left-circle h1"></i>
        </div>

        <div class="results__scrollbar">
            <div class="results__container">
                {{-- Code in JS --}}
            </div>
        </div>

        <div id="results__paginator-right" class="paginator-right flex-center-column">
            <i class="bi bi-arrow-right-circle h1"></i>
        </div>
        
    </div>
    <div class="paginator flex-center-column">
        <p class="counter"></p>
    </div>
</section>
{{-- End Results --}}
