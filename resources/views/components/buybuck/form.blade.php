{{-- Form --}}
<section id="form" class="flex-center-column">
    <h3 class="form__heading">Or send your offer via our website:</h3>
    <form action="/sendConfirmationCodeBuyback" method="post" class="form__form flex-center-column" enctype="multipart/form-data">
        @csrf
        <input id="nameSurname" name="nameSurname" placeholder="Name and surname (required)" class="form__text" type="text" required>
        <input id="email" name="email" placeholder="E-mail (required)" class="form__text" type="text" required>
        <input id="phone" name="phone" placeholder="Phone number (required)" class="form__text" type="text" required>
        <textarea id="message" name="message" placeholder="Message" class="form__message" required></textarea>

        <label for="sendForm" class="form__label">Add the form</label>
        <input type="file" id="sendForm" name="sendForm" hidden required>
        <span class="form__span form__send-form">Click above and add the form</span>
        
        <label for="bikeImages" class="form__label">Add pictures</label>
        <input class="custom-file-input" type="file" id="bikeImages" name="bikeImages[]" accept="image/*" hidden multiple required>
        <span class="form__span form__images">Click above and select pictures (up to 5)</span>

        <button class="form__button">Send</button>
    </form>
</section>
{{-- End Form --}}

