@extends('sketch')

@section('sketch')
    @include('includes.adminNav')

    <h4><a href="/admin">Wróć do strony administratora!</a></h4>

    <br>

    <h2>Tablica zapytań ze strony głównej:</h2>

    <table>
        <tr class='naPrzemian'>
            <th>ID</th>
            <th>IMIE I NAZWISKO</th>
            <th>EMAIL</th>
            <th>NAZWA FIRMY</th>
            <th style="width: 600px;">WIADOMOŚĆ</th>
        </tr>
        @foreach($zapNiez as $zap)
            <tr class='naPrzemian'>
                <th>{{ $zap->id }}</th>
                <th>{{ $zap->imieNazwisko }}</th>
                <th>{{ $zap->email }}</th>
                <th>{{ $zap->nazwaFirmy }}</th>
                <th style="width: 600px;">{{ $zap->wiadomosc }}</th>
            </tr>
        @endforeach
    </table>

    <br>

    <h2>Tablica zapytań odnośnie konkretnego robota :</h2>

    <table>
        <tr class='naPrzemian'>
            <th>ID</th>
            <th>IMIE I NAZWISKO</th>
            <th>EMAIL</th>
            <th>NAZWA FIRMY</th>
            <th>NAZWA ROBOTA</th>
            <th style="width: 600px;">WIADOMOŚĆ</th>
        </tr>
        @foreach($zapNiezRob as $zap)
            <tr class='naPrzemian'>
                <th>{{ $zap->id }}</th>
                <th>{{ $zap->imieNazwisko }}</th>
                <th>{{ $zap->email }}</th>
                <th>{{ $zap->nazwaFirmy }}</th>
                @foreach($robots as $robot)
                    @if($robot->id == $zap->robot_id)
                        <th>{{ $robot->nazwa }}</th>
                    @endif
                @endforeach
                <th style="width: 500px;">{{ $zap->wiadomosc }}</th>
            </tr>
        @endforeach
    </table>

    <br><br>

    <h2>WYSŁANE FORMULARZE (ze strony Skup):</h2>

    <table>
        <tr class='naPrzemian'>
            <th>ID</th>
            <th>IMIE I NAZWISKO</th>
            <th>EMAIL</th>
            <th>NAZWA FIRMY</th>
            <th style="width: 600px;">WIADOMOŚĆ</th>
            <th>ZDJĘCIE FORMULARZA</th>
            <th>ZDJĘCIA ROBOTA</th>
        </tr>
        @foreach($formularze as $zap)
            <tr class='naPrzemian'>
                <th>{{ $zap->id }}</th>
                <th>{{ $zap->imieNazwisko }}</th>
                <th>{{ $zap->email }}</th>
                <th>{{ $zap->nazwaFirmy }}</th>
                <th style="width: 500px;">{{ $zap->wiadomosc }}</th>
                @foreach($f_formularza as $form)
                    @if($form->formularz_id == $zap->id)
                        <th><a href="{{ asset('images/'. $form->formularz) }}" download>POBIERZ WYSŁANY FORMULARZ</a></th>
                        @break
                    @endif
                @endforeach
                <th><a href="/admin/showAll/downloadPhotos/{{ $zap->id }}">POBIERZ ZDJĘCIA ROBOTA Z FORMULARZA</a></th>
            </tr>
        @endforeach
    </table>
    
    <br>

    @include('includes.adminNav2')
@endsection
