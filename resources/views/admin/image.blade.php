@extends('sketch')

@section('sketch')
    @include('includes.adminNav')

    <h4><a href="/admin">Wróć do strony administratora!</a></h4>

    <center><h3>Na tej stronie można przypisać zdjęcia robotom.</h3></center>


    <form class='create' action="/admin/image/create" method="post" enctype="multipart/form-data">
        @csrf
        <div class="machine_details2">
            <div class="input_first">
                <label for="przez">Robot</label>
                <select name="robot_id" id="robot_id" class="one">
                    @foreach($roboty as $rob)
                        <option value="{{ $rob->id }}">{{ $rob->nazwa }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <center><p>DODAJ ZDJĘCIE</p></center>
        <input name="image" type="file" id="image">
        @error('image')
        <small class="text-danger">{{ $message }}</small>
        @enderror

        <br><br>

        <button type="submit">Przypisz zdjęcie</button>
    </form>

    @include('includes.adminNav2')
@endsection
