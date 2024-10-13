@extends('sketch')

@section('sketch')
    @include('includes.adminNav')

    <h4><a href="/admin">Wróć do strony administratora!</a></h4>

    <center><h3>Na tej stronie można wybrać do edycji rower poniższej listy.</h3></center>

    <center><h2>Lista robotów do edycji:</h2></center>
    
    <table class="table1">
        <tr>
            <th class="kolor">ZDJĘCIE</th>
            <th class="kolor">NAZWA</th>
            <th class="kolor">LINK DO STRONY</th>
        </tr>
        @foreach($roboty as $robot)
            <tr>
                @foreach($images as $image)
                    @if($image->robot_id == $robot->id)
                        <th><img class="zdjecie_robot" src="/images/{{ $image->image }}"></th>
                        @break
                    @endif
                @endforeach
                <th><a style="color: black" href="/admin/choose/{{ $robot->id }}">{{ $robot->nazwa }}</a></th>
                <th><a class="link" href="https://robotyuzywane.pl/showRobot/{{ $robot->id }}">https://robotyuzywane.pl/showRobot/{{ $robot->id }}</a></th>
            </tr>
        @endforeach
    </table>


    @include('includes.adminNav2')
@endsection
