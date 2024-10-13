@extends('app')

@include('components.menu')

{{-- Success --}}
<div class="line flex-center-row">
    <p class="success-text">Success!</p>
</div>
{{-- End Success --}}

{{-- Form sent --}}
<div id="form-sent" class="flex-center-column">
    <h4>The form is propery sent!</h4>
    <a class="form-sent__link" href="/">Click and back to the searcher</a>
</div>
{{-- End Form sent --}}

<script src={{ asset('/scripts/menu.js') }}></script>


