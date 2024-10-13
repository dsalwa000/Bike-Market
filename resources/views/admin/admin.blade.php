@extends('sketch')

@section('sketch')
    @include('includes.adminNav')

    <br>
    <center><h1>Witaj na stronie administratora!</h1></center>
    <center><h3>Wybierz odpowiednią opcję z paska na górze by móc zarządzać stroną!</h3></center>
    <br>
    
    <center>JEŻELI CHCESZ EDYTOWAĆ TREŚĆ STRON INFORMACYJNYCH KLIKNIJ <b><a href="/admin/editPages" style="color: black">TUTAJ</a></b></center><br>


    @include('includes.adminNav2')
@endsection
