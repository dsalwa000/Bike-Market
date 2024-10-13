@extends('app')

@include('components.menu')

{{-- Rejacted --}}
<div class="line flex-center-row">
    <p class="success-text">You couldn't send this form</p>
</div>
{{-- End Rejacted --}}

{{-- Form sent --}}
<div id="form-sent" class="flex-center-column">
    <h4>You could type incorrect emial or the session is expired. Try to send once again!</h4>
    <a class="form-sent__link" href="/">Click and back to the main page!</a>
</div>
{{-- End Form sent --}}

<script src={{ asset('/scripts/menu.js') }}></script>




