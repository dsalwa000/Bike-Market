@extends('sketch')

@section('sketch')
    @include('includes.adminNav')
    
    <h4><a href="/admin/editPages">Wróć do listy stron!</a></h4>
    
    <br>

    <form action="/admin/editPages/programowanie/{{ $prog->id }}" method="post">
        @csrf

        @method('PATCH')

        <label for="przez">Zmień górny napis:</label>
        <textarea style="height: 30px; width: 400px;" name="gora" id="gora">{{ $prog->gora }}</textarea>
        @error('gora')
        <small class="text-danger">{{ $message }}</small>
        @enderror

        <label for="przez">Zmień tekst główny:</label>
        <textarea style="height: 160px; width: 700px;" name="text" id="text"></textarea>
        @error('text')
        <small class="text-danger">{{ $message }}</small>
        @enderror

        <br>

        <center><button type="submit">DOKONAJ ZMIAN</button></center><br>
    </form>

    <div hidden id="token">{{ $prog->text }}</div>

    @include('includes.adminNav2')

    <script src={{ asset('/scripts/tinymce/tinymce.min.js') }}></script>

    <script>
        const token = document.querySelector('div[id=token]').textContent
        tinymce.init({
            selector: 'textarea#text',
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
