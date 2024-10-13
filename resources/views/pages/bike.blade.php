
@extends('app')

@include('components.menu')

@include('components.bike.shortText')

@include('components.bike.showBike')

@include('components.bike.downloadPDF')

@include('components.bike.form')

@include('components.footer')

@include('components.emptySpace')

{{-- JS --}}
<script>
    var website = "bike";
    var bikes = @json($bikes);
    var images = @json($images);

    var thisBike = @json($thisBike);

    var thisLocalisation = @json($thisLocalisation);
    var thisProducent = @json($thisProducent);
    var thisPurpose = @json($thisPurpose);
    var thisCondition = @json($thisCondition);
    var bikeImagesList = @json($bikeImages)
</script>
<script src={{ asset('/scripts/pdf.js') }}></script>
<script src={{ asset('/scripts/footer.js') }}></script>
<script src={{ asset('/scripts/bike.js') }}></script>
<script src={{ asset('/scripts/menu.js') }}></script>






