@extends('sketch')

@section('sketch')
    @include('includes.adminNav')
    
    <h4><a href="/admin/editPages">Wróć do listy stron!</a></h4>
    
    <br>

    <form action="/admin/editPages/wspolne/{{ $ban->id }}" method="post">
        @csrf

        @method('PATCH')

        <label for="przez">Zmień część informacyjną (dolny szary pasek w O nas i Kontakt i środkowy w Programowanie):</label>
        <textarea style="height: 30px; width: 400px;" name="pytanie" id="pytanie">{{ $ban->pytanie }}</textarea>
        @error('gora')
        <small class="text-danger">{{ $message }}</small>
        @enderror

        <label for="przez">Zmień napis przed formularzem (wszystkie strony oprócz Skup):</label>
        <textarea style="height: 30px; width: 400px;" name="napisz" id="napisz">{{ $ban->napisz }}</textarea>
        @error('napisz')
        <small class="text-danger">{{ $message }}</small>
        @enderror

        <label for="przez">Zmień link do strony głównej (dolny szary pasek w Programowanie i Finansowanie):</label>
        <textarea style="height: 30px; width: 400px;" name="przejdz" id="przejdz">{{ $ban->przejdz }}</textarea>
        @error('przejdz')
        <small class="text-danger">{{ $message }}</small>
        @enderror

        <br>

        <center><button type="submit">DOKONAJ ZMIAN</button></center><br>
    </form>

    @include('includes.adminNav2')

@endsection
