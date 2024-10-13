@extends('sketch')

@section('sketch')
    @include('includes.adminNav')
    <h4><a href="/admin">Wróć do strony administratora!</a></h4>
    
    <br>

    WYBIERZ STRONĘ DO EDYCJI:<br>
    <ul>
        <li><a href="/admin/editPages/glowna">Główną(Oferty)</a></li><br>
        <li><a href="/admin/editPages/onas">O NAS</a></li><br>
        <li><a href="/admin/editPages/programowaie">PROGRAMOWANIE</a></li><br>
        <li><a href="/admin/editPages/skup">SKUP</a></li><br>
        <li><a href="/admin/editPages/finansowanie">FINANSOWANIE</a></li><br>
        <li><a href="/admin/editPages/kontakt">KONTAKT</a></li><br>
        <li><a href="/admin/editPages/wspolne">CZĘŚCI WSPÓLNE STRON</a></li><br>
    </ul>

    @include('includes.adminNav2')
@endsection
