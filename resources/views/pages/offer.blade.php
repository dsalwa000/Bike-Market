
@extends('app')

@include('components.menu')

@include('components.shortText')

@include('components.slider')

@include('components.mobileBikePicture')

@include('components.searcher')

@include('components.generalInformation')

@include('components.downloadPDF')

@include('components.form')

@include('components.footer')

@include('components.emptySpace')


{{-- JS --}}
<script>
    const website = "offer";

    const bikes = @json($bikes);
    const images = @json($images);
    const localisation = @json($localisation);
    const producent = @json($producent);
    const purpose = @json($purpose);
    const condition = @json($condition);
</script>
<script src={{ asset('/scripts/pdf.js') }}></script>
<script src={{ asset('/scripts/footer.js') }}></script>
<script src={{ asset('/scripts/searcher.js') }}></script>
<script src={{ asset('/scripts/scripts.js') }}></script>
<script src={{ asset('/scripts/menu.js') }}></script>


















