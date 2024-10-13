@extends('sketch')

@section('sketch')
    @include('includes.adminNav')

    <center><h4><a href="/admin/showAll">Wróć!</a></h4></center>

    <center><h2>Zdjęcia robota: {{ $rob[0]->nazwa }}</h2></center>

    <div class="single-item">
        @foreach($robotImages as $image)
            <img class="single" src="{{ asset("images/" . $image->image) }}">
        @endforeach
        <div class="pagination2">
            <div class="prev2">Poprzednie zdjęcie</div>
            <div class="page2">Zdjęcie <span class="robotImage"></span></div>
            <div class="next2">Następne zdjęcie</div>
        </div>
    </div>

    <!--OUR SCRIPTS--->
    <script src={{ asset('/scripts/robot.js') }}></script>

    @include('includes.adminNav2')
@endsection
