@extends('app')

@include('components.menu')

@include('components.shortText')

@include('components.slider')

@include('components.mobileBikePicture')

@include('components.aboutUs.generalInformation')

@include('components.form')

@include('components.footer')

@include('components.emptySpace')


{{-- JS --}}
<script>
    var website = "aboutus";

    var bikes = @json($bikes);
    var images = @json($images);
    var localisation = @json($localisation);
    var producent = @json($producent);
    var purpose = @json($purpose);
    var condition = @json($condition);
</script>
<script src={{ asset('/scripts/footer.js') }}></script>
<script src={{ asset('/scripts/scripts.js') }}></script>
<script src={{ asset('/scripts/menu.js') }}></script>




