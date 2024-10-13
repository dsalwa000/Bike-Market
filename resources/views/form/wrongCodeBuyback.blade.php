@extends('app')

@include('components.menu')

{{-- General Information --}}
<section id="confirm-mail" class="flex-center-column">
        <h3 class="confirm-mail__heading">The content of the message you want to send:</h3>
        <p class="confirm-mail__message"> {{ $data['message'] }} </p>

        <h3 class="confirm-mail__heading">Type the code from your email:</h3>
        <form action="/sendFormBuyback" method="POST" class="confirm-mail__form flex-center-column" enctype="multipart/form-data">
            @csrf
            <input name="confirmationCode" id="confirmationCode" class="confirm-mail__input" placeholder="Your 4-digit code">
            <p class="text-danger">Wrong code try again.</p>
            <input value="{{ $codeEncrypted }}" name="codeEncrypted" id="codeEncrypted" hidden required>
            <input value="{{ $data['nameSurname'] }}" name="nameSurname" id="nameSurname" hidden required>
            <input value="{{ $data['email'] }}" name="email" id="email" hidden required>
            <input value="{{ $data['phone'] }}" name="phone" id="phone" hidden required><br>
            <input value="{{ $data['message'] }}" name="message" id="message" hidden required>
            <button type="submit" class="confirm-mail__button">Send</button>
        </form>

        <p class="confirm-mail__information">If you didn't get a mail <b>contact us via mail (bike@mail.com)</b>, call us at <b>+48 000 000 000</b> or</p>

        <a class="confirm-mail__link-to-searcher" href=""><b>back to the searcher</b></a>
    </div>
</section>
{{-- End General Information --}}

@include('components.emptySpace')

<script>
    const form = @json($form);
    const bikeImages = @json($bikeImages);
</script>
<script src={{ asset('/scripts/buybackForm.js') }}></script> 
<script src={{ asset('/scripts/menu.js') }}></script>


