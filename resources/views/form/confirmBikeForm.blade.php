@extends('app')

@include('components.menu')

{{-- General Information --}}
<section id="confirm-mail" class="flex-center-column">
        <h3 class="confirm-mail__heading">The content of the message you want to send:</h3>
        <p class="confirm-mail__message"> {{ $data['message'] }} </p>

        <h3 class="confirm-mail__heading">Type the code from your email:</h3>
        <form action="/sendFormSingleBike" method="POST" class="confirm-mail__form flex-center-column">
            @csrf
            <input name="confirmationCode" id="confirmationCode" class="confirm-mail__input" placeholder="Your 4-digit code">
            <input value="{{ $codeEncrypted }}" name="codeEncrypted" id="codeEncrypted" hidden>
            <input value="{{ $data['nameSurname'] }}" name="nameSurname" id="nameSurname" hidden>
            <input value="{{ $data['email'] }}" name="email" id="email" hidden>
            <input value="{{ $data['phone'] }}" name="phone" id="phone" hidden><br>
            <input value="{{ $data['message'] }}" name="message" id="message" hidden>
            <input value="{{ $bikeId }}" name="bikeId" id="bikeId" hidden>
            <button type="submit" class="confirm-mail__button">Send</button>
        </form>

        <p class="confirm-mail__information">If you didn't get a mail <b>contact us via mail (bike@mail.com)</b>, call us at <b>+48 000 000 000</b> or</p>

        <a class="confirm-mail__link-to-searcher" href="/"><b>Back to the searcher</b></a>
    </div>
</section>
{{-- End General Information --}}

@include('components.emptySpace')

<script src={{ asset('/scripts/menu.js') }}></script>
