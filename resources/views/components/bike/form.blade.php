{{-- Form --}}
<section id="form" class="flex-center-column">
    <h3 class="form__heading">Send a direct form about this model:</h3>
    <form action="/sendConfirmationCodeSingleBike/{{ $bike }}" method="post" class="form__form flex-center-column">
        @csrf
        <input id="nameSurname" name="nameSurname" placeholder="Name and surname (required)" class="form__text" type="text" required>
        <input id="email" name="email" placeholder="E-mail (required)" class="form__text" type="text" required>
        <input id="phone" name="phone" placeholder="Phone number (required)" class="form__text" type="text" required>
        <textarea id="message" name="message" placeholder="Message" class="form__message" required></textarea>
        <button class="form__button">Send</button>
    </form>
</section>
{{-- End Form --}}