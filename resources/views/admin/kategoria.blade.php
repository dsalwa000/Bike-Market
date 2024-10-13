@extends('sketch')

@section('sketch')
    @include('includes.adminNav')

    <h4><a href="/admin">Wróć do strony administratora!</a></h4>

    <center><h3>Na tej stronie można dodawać filtry które przypisuje się odpowiednim robotom.</h3></center>

    <div class="input_first">

        <form action="/admin/kontroler" method="post">
            @csrf

            <label for="przez">Kontroler</label>
            <input name="kontroler" type="text" id="kontroler">
            @error('kontroler')
            <small class="text-danger">{{ $message }}</small>
            @enderror
            <button type="submit" name="form1">Dodaj Kontroler</button>
        </form>

        <br>

        <form action="/admin/stanowisko" method="post">
            @csrf
            <label for="przez">Stanowisko</label>
            <input name="stanowisko" type="text" id="stanowisko">
            @error('stanowisko')
            <small class="text-danger">{{ $message }}</small>
            @enderror
            <button type="submit" name="form2">Dodaj Stanowisko</button>
        </form>

        <br>

        <form action="/admin/przeznaczenie" method="post">
            @csrf
            <label for="przez">Przeznaczenie</label>
            <input name="przeznaczenie" type="text" id="przeznaczenie">
            @error('przeznaczenie')
            <small class="text-danger">{{ $message }}</small>
            @enderror
            <button type="submit" name="form3">Dodaj Przeznaczenie</button>
        </form>

        <br>

        <form action="/admin/producent" method="post">
            @csrf
            <label for="przez">Producent</label>
            <input name="producent" type="text" id="producent">
            @error('producent')
            <small class="text-danger">{{ $message }}</small>
            @enderror
            <button type="submit" name="form4">Dodaj Producent</button>
        </form>

        <br>

        <form action="/admin/stan" method="post">
            @csrf
            <label for="przez">Stan techniczny</label>
            <input name="stan" type="text" id="stan">
            @error('stan')
            <small class="text-danger">{{ $message }}</small>
            @enderror
            <button type="submit" name="form5">Dodaj Stan Techniczny</button>
        </form>

        <br>

        <form action="/admin/liczba_osi" method="post">
            @csrf
            <label for="przez">Liczba osi</label>
            <input name="liczba_osi" type="number" id="liczba_osi">
            @error('liczba_osi')
            <small class="text-danger">{{ $message }}</small>
            @enderror
            <button type="submit" name="form6">Dodaj parametr Liczba Osi</button>
        </form>
    </div>

    <br>

    @include('includes.adminNav2')
@endsection
