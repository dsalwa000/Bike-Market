@extends('sketch')

@section('sketch')
    @include('includes.adminNav')

    <h4><a href="/admin">Wróć do strony administratora!</a></h4>

    <center><h3>Na tej stronie można usunąć robota lub katygorię z jednej z poniższych list rozwijanych.</h3></center>

    <div class="input_first">
        <form action="/admin/delete/robot" method="post">
            @csrf
            @method('DELETE')
            <label for="przez">Robot</label>
            <select name="robot" id="robot" class="one">
                @foreach($rob as $r)
                    <option value="{{ $r->id }}">{{ $r->nazwa }}</option>
                @endforeach
            </select>
            <button type="submit">Usuń wybranego Robota</button>
        </form>

        <form action="/admin/delete/przeznaczenie" method="post">
            @csrf
            @method('DELETE')
            <label for="przez">Przeznaczenie(proces)</label>
            <select name="przeznaczenie_id" id="przeznaczenie_id" class="one">
                @foreach($przeznaczenie as $prz)
                    <option value="{{ $prz->id }}">{{ $prz->przeznaczenie }}</option>
                @endforeach
            </select>
            <button type="submit">Usuń wybraną kategorię Przeznaczenie</button>
        </form>

        <form action="/admin/delete/osie" method="post">
            @csrf
            @method('DELETE')
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
            <button type="submit">Usuń wybraną kategorię Liczba Osi</button>
        </form>
    </div>

    <div class="input_first">
        <form action="/admin/delete/producent" method="post">
            @csrf
            @method('DELETE')
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
            <button type="submit">Usuń wybraną kategorię Producent</button>
        </form>

        <form action="/admin/delete/stanowisko" method="post">
            @csrf
            @method('DELETE')
            <label for="robot">Robot/kompletne stanowisko</label>
            <select name="stanowisko_id" id="stanowisko_id" class="one">
                @foreach($stanowisko as $st)
                    @if($loop->index == 0)
                        @continue
                    @else
                        <option value="{{ $st->id }}">{{ $st->stanowisko }}</option>
                    @endif
                @endforeach
            </select>
            <button type="submit">Usuń wybraną kategorię Stanowisko</button>
        </form>
    </div>

    <div class="input_first">
        <form action="/admin/delete/kontroler" method="post">
            @csrf
            @method('DELETE')
            <label for="producent">Kontroler</label>
            <select name="kontroler_id" id="kontroler_id" class="one">
                @foreach($kontroler as $kon)
                    @if($loop->index == 0)
                        @continue
                    @else
                        <option value="{{ $kon->id }}">{{ $kon->kontroler }}</option>
                    @endif
                @endforeach
            </select>
            <button type="submit">Usuń wybraną kategorię Kontroler</button>
        </form>

        <form action="/admin/delete/stan" method="post">
            @csrf
            @method('DELETE')
            <label for="robot">Stan techniczny</label>
            <select name="stan_techniczny_id" id="stan_techniczny_id" class="one">
                @foreach($stan_techniczny as $stan)
                    <option value="{{ $stan->id }}">{{ $stan->stan }}</option>
                @endforeach
            </select>
            <button type="submit">Usuń wybraną kategorię Stan techniczny</button>
        </form>
    </div>

    @include('includes.adminNav2')
@endsection
