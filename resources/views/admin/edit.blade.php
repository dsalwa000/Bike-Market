@extends('sketch')

@section('sketch')
    @include('includes.adminNav')

    <h4><a href="/admin">Wróć do strony administratora!</a></h4>

    <center><h3>Edytuj wybranego robota!</h3></center>

    <form action="/admin/choose/{{ $rob[0]->id }}/change" method="post">
        @csrf

        @method('PATCH')

        <div class="input_first">
            <label for="przez">Przeznaczenie(proces)</label>
            <select name="przeznaczenie_id" id="przeznaczenie_id" class="one">
                @foreach($przeznaczenie as $prz)
                    @if($loop->index == 0)
                        @continue
                    @else
                        @if($rob[0]->przeznaczenie_id == $prz->id)
                            <option value="{{ $prz->id }}" selected="selected">{{ $prz->przeznaczenie }}</option>
                        @else
                            <option value="{{ $prz->id }}">{{ $prz->przeznaczenie }}</option>
                        @endif
                    @endif
                @endforeach
            </select>

            <label for="osie">Liczba przerzutek (0 oznacza wszystkie możliwości)</label>
            <select name="liczba_osi_id" id="liczba_osi_id" class="one">
                @foreach($osie as $os)
                    @if($loop->index == 0)
                        @continue
                    @else
                        @if($rob[0]->liczba_osi_id == $os->id)
                            <option value="{{ $os->id }}" selected="selected">{{ $os->liczba_osi }}</option>
                        @else
                            <option value="{{ $os->id }}">{{ $os->liczba_osi }}</option>
                        @endif
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
                        @if($rob[0]->producent_id == $pr->id)
                            <option value="{{ $pr->id }}" selected="selected">{{ $pr->producent }}</option>
                        @else
                            <option value="{{ $pr->id }}">{{ $pr->producent }}</option>
                        @endif
                    @endif
                @endforeach
            </select>

            <label for="robot">Stan techniczny</label>
            <select name="stanowisko_id" id="stanowisko_id" class="one">
                @foreach($stanowisko as $st)
                    @if($loop->index == 0)
                        @continue
                    @else
                        @if($rob[0]->stanowisko_id == $st->id)
                            <option value="{{ $st->id }}" selected="selected">{{ $st->stanowisko }}</option>
                        @else
                            <option value="{{ $st->id }}">{{ $st->stanowisko }}</option>
                        @endif
                    @endif
                @endforeach
            </select>
        </div>

        <!-- <div class="input_first">
            <label for="producent">Kontroler</label>
            <select name="kontroler_id" id="kontroler_id" class="one">
                @foreach($kontroler as $kon)
                    @if($loop->index == 0)
                        @continue
                    @else
                        @if($rob[0]->kontroler_id == $kon->id)
                            <option value="{{ $kon->id }}" selected="selected">{{ $kon->kontroler }}</option>
                        @else
                            <option value="{{ $kon->id }}">{{ $kon->kontroler }}</option>
                        @endif
                    @endif
                @endforeach
            </select>

            <label for="robot">Stan techniczny</label>
            <select name="stan_techniczny_id" id="stan_techniczny_id" class="one">
                @foreach($stan_techniczny as $stan)
                    @if($rob[0]->stan_techniczny_id == $stan->id)
                        <option value="{{ $stan->id }}" selected="selected">{{ $stan->stan }}</option>
                    @endif
                    <option value="{{ $stan->id }}">{{ $stan->stan }}</option>
                @endforeach
            </select>
        </div> -->

        <div class="poprawka">
            <label for="przez">Nazwa</label>
            <input class="typeRobot" name="nazwa" type="text" id="nazwa" value="{{ old('nazwa') ?? $rob[0]->nazwa }}">
            @error('nazwa')
            <small class="text-danger">{{ $message }}</small>
            @enderror

            <label for="przez">Osprzęt</label>
            <input class="typeRobot" name="osprzęt" type="text" id="osprzęt" value="{{ old('osprzęt') ?? $rob[0]->osprzęt }}">
            @error('osprzęt')
            <small class="text-danger">{{ $message }}</small>
            @enderror

            <label for="przez">Wymiary</label>
            <input class="typeRobot" name="wymiary" type="text" id="wymiary" value="{{ old('wymiary') ?? $rob[0]->wymiary }}">
            @error('wymiary')
            <small class="text-danger">{{ $message }}</small>
            @enderror

            <label for="przez">Telefon</label>
            <input class="typeRobot" name="telefon" type="text" id="telefon" value="{{ old('telefon') ?? $rob[0]->telefon }}">
            @error('telefon')
            <small class="text-danger">{{ $message }}</small>
            @enderror

            <!-- <label for="przez">Rocznik</label>
            <input class="typeRobot" name="rocznik" type="number" id="rocznik" value="{{ old('rocznik') ?? $rob[0]->rocznik }}">
            @error('rocznik')
            <small class="text-danger">{{ $message }}</small>
            @enderror -->

            <label for="przez">Rocznik</label>
            <input class="typeRobot" name="udzwig" type="number" id="udzwig" value="{{ old('udzwig') ?? $rob[0]->udzwig }}">
            @error('udzwig')
            <small class="text-danger">{{ $message }}</small>
            @enderror

            <label for="przez">Liczba wcześniejszych właścicieli</label>
            <input  class="typeRobot" name="zasieg" type="number" id="zasieg" value="{{ old('zasieg') ?? $rob[0]->zasieg }}">
            @error('zasieg')
            <small class="text-danger">{{ $message }}</small>
            @enderror
            
            <label for="przez">Wprowadź opis</label>
                <textarea style="height: 300px; width: 550px;" name="opis" id="opis"></textarea>
                @error('opis')
                <small class="text-danger">{{ $message }}</small>
                @enderror

            <br><br>

            <button type="submit">Zapisz edycję!</button>
        </div>
    </form>
    
    <div hidden id="token">{{ $rob[0]->opis }}</div>

    <br>
    @include('includes.adminNav2')
    
        <!--EDIT AREA-->
    <script src={{ asset('/scripts/tinymce/tinymce.min.js') }}></script>

        <script>
        const token = document.querySelector('div[id=token]').textContent
        tinymce.init({
            selector: 'textarea#opis',
            setup: function (editor) {
                editor.on('init', function (e) {
                    editor.setContent(token);
                });
            },
            plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            imagetools_cors_hosts: ['picsum.photos'],
            menubar: 'file edit view insert format tools table help',
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            autosave_interval: "30s",
            autosave_prefix: "{path}{query}-{id}-",
            autosave_restore_when_empty: false,
            autosave_retention: "2m",
            image_advtab: true,
            /*content_css: '//www.tiny.cloud/css/codepen.min.css',*/
            link_list: [
                { title: 'My page 1', value: 'https://www.codexworld.com' },
                { title: 'My page 2', value: 'https://www.xwebtools.com' }
            ],
            importcss_append: true,
            file_picker_callback: function (callback, value, meta) {
                /* Provide file and text for the link dialog */
                if (meta.filetype === 'file') {
                    callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
                }

                /* Provide image and alt text for the image dialog */
                if (meta.filetype === 'image') {
                    callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
                }
            },
            templates: [
                { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
                { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
                { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
            ],
            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            height: 600,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: "mceNonEditable",
            toolbar_mode: 'sliding',
            contextmenu: "link image imagetools table",
        });
    </script>
    
@endsection
