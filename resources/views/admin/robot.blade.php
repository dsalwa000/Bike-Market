@extends('sketch')

@section('sketch')
    @include('includes.adminNav')

    <h4><a href="/admin">Wróć do strony administratora!</a></h4>

    <center><h3>Dodaj nowego robota.</h3></center>


    <div class="createRobot">
        <form action="/admin/robot/crate" method="post" enctype="multipart/form-data">
            @csrf
            <div class="input_first">
                <label for="przez">Przeznaczenie(proces)</label>
                <select name="przeznaczenie_id" id="przeznaczenie_id" class="one">
                    @foreach($przeznaczenie as $prz)
                        @if($loop->index == 0)
                            @continue
                        @else
                            <option value="{{ $prz->id }}">{{ $prz->przeznaczenie }}</option>
                        @endif
                    @endforeach
                </select>

                <label for="osie">Liczba osi (0 oznacza wszystkie możliwości)</label>
                <select name="liczba_osi_id" id="liczba_osi_id" class="one">
                    @foreach($osie as $os)
                        @if($loop->index == 0)
                            @continue
                        @else
                            <option value="{{ $os->id }}">{{ $os->liczba_osi }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="input_first">
                <label for="producent">Producent</label>
                <select name="producent_id" id="producent_id" class="one">
                    @foreach($producent as $pr)
                        @if($loop->index == 0)
                            @continue
                        @else
                            <option value="{{ $pr->id }}">{{ $pr->producent }}</option>
                        @endif
                    @endforeach
                </select>

                <label for="robot">Stan techniczny:</label>
                <select name="stanowisko_id" id="stanowisko_id" class="one">
                    @foreach($stanowisko as $st)
                        @if($loop->index == 0)
                            @continue
                        @else
                            <option value="{{ $st->id }}">{{ $st->stanowisko }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="input_first">
                <!-- <label for="producent">Kontroler</label>
                <select name="kontroler_id" id="kontroler_id" class="one">
                    @foreach($kontroler as $kon)
                        @if($loop->index == 0)
                            @continue
                        @else
                            <option value="{{ $kon->id }}">{{ $kon->kontroler }}</option>
                        @endif
                    @endforeach
                </select> -->

                <!-- <label for="robot">Stan techniczny</label>
                <select name="stan_techniczny_id" id="stan_techniczny_id" class="one">
                    @foreach($stan_techniczny as $stan)
                        <option value="{{ $stan->id }}">{{ $stan->stan }}</option>
                    @endforeach
                </select> -->
            </div>

            <div class="poprawka">
                <label for="przez">Nazwa</label>
                <input class="typeRobot" name="nazwa" type="text" id="nazwa">
                @error('nazwa')
                <small class="text-danger">{{ $message }}</small>
                @enderror

                <label for="przez">Osprzęt</label>
                <input class="typeRobot" name="osprzęt" type="text" id="osprzęt">

                <label for="przez">Wymiary</label>
                <input class="typeRobot" name="wymiary" type="text" id="wymiary">

                <label for="przez">Telefon</label>
                <input class="typeRobot" name="telefon" type="text" id="telefon">

                <!-- <label for="przez">Rocznik</label>
                <input class="typeRobot" name="rocznik" type="number" id="rocznik"> -->

                <label for="przez">Rocznik</label>
                <input class="typeRobot" name="udzwig" type="number" id="udzwig">
                @error('udzwig')
                <small class="text-danger">{{ $message }}</small>
                @enderror

                <label for="przez">Liczba wcześniejszych właścicieli</label>
                <input class="typeRobot" name="zasieg" type="number" id="zasieg">
                @error('zasieg')
                <small class="text-danger">{{ $message }}</small>
                @enderror

                <label for="przez">PDF</label>
                <input class="typeRobot" name="image" type="file" id="image">
                @error('image')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                
                <label for="przez">Wprowadź opis</label>
                <textarea style="height: 300px; width: 550px;" name="opis" id="opis"></textarea>
                @error('opis')
                <small class="text-danger">{{ $message }}</small>
                @enderror

                <br><br>
                <button type="submit">Dodaj Rower!</button>
            </div>
        </form>
    </div>

    @include('includes.adminNav2')
    
        <!--EDIT AREA-->
    <script src={{ asset('/scripts/tinymce/tinymce.min.js') }}></script>

    <script>
        tinymce.init({
            selector: 'textarea#opis',
        });
    </script>
    
@endsection
