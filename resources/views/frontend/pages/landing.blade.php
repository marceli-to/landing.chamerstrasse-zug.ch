@extends('frontend.layout.app')
@section('content')
@if ($state)
<div class="alert js-alert">
  <div>Vielen Dank für Ihr Interesse. Wir werden Ihre Anfrage so schnell als möglich bearbeiten.</div>
</div>
@endif

<figure class="visual-bg">

</figure>
<section class="page-section is-dark">
  <div class="page-inner">
    <article>
      <h1>Wohnen in unmittelbarer Lage zum Zugersee</h1>
      <p><strong>Erstvermietung</strong><br>An der Chamerstrasse 68 a/b & 70 a/b in 6300 Zug entstehen per Mitte 2024 neue, moderne 2.5- bis 4.5-Zimmerwohnungen. Die Wohnungen befinden sich in Gehdistanz zum Zugersee.</p>
      <p>Gerne senden wir Ihnen weitere Informationen, sobald die Vermietung startet. Bitte füllen Sie bei Interesse das Kontaktformular aus.</p>
    </article>
  </div>
</section>
<section class="page-section is-light">
  <div class="page-inner">
    <article>
      <h1>Kontaktformular</h1>
      <p>Ich möchte gerne weitere Informationen erhalten, sobald die Vermietung startet.</p>
      <form method="POST" action="{{ route('page_landing_subscribe') }}" class="contact-form js-validate">
        @csrf

        @if ($errors->has('interest'))
          <div class="error-message">{{ $errors->first('interest') }}</div>
        @else
          <div class="error-message" style="display:none">Bitte mind. 1 Option auswählen</div>
        @endif
        <div class="form-controls__grid">
          <div class="span">
            <div class="form-control">
              <input type="checkbox" name="interest[]" value="2.5 Zi" id="interest-2.5">
              <label for="interest-2.5">2.5-Zimmerwohnung</label>
            </div>
          </div>
          <div class="span">
            <div class="form-control">
              <input type="checkbox" name="interest[]" value="3.5 Zi" id="interest-3.5">
              <label for="interest-3.5">3.5-Zimmerwohnung</label>
            </div>
          </div>
          <div class="span">
            <div class="form-control">
              <input type="checkbox" name="interest[]" value="4.5 Zi" id="interest-4.5">
              <label for="interest-4.5">4.5-Zimmerwohnung</label>
            </div>
          </div>
        </div>
        <div class="grid-2x1">
          <div class="span">
            @if ($errors->has('firstname'))
              <div class="error-message is-floating">{{ $errors->first('firstname') }}</div>
            @else 
              <div class="error-message is-floating" style="display:none">Vorname muss ausgefüllt sein!</div>
            @endif
            <input type="text" name="firstname" placeholder="Vorname *" data-rules="required">
          </div>
          <div class="span">
            @if ($errors->has('name'))
              <div class="error-message is-floating">{{ $errors->first('name') }}</div>
            @else 
              <div class="error-message is-floating" style="display:none">Name muss ausgefüllt sein!</div>
            @endif
            <input type="text" name="name" placeholder="Name *" data-rules="required">
          </div>
          <div class="span">
            @if ($errors->has('email'))
              <div class="error-message is-floating">{{ $errors->first('email') }}</div>
            @else 
              <div class="error-message is-floating" style="display:none">E-Mail-Adresse muss gültig sein!</div>
            @endif
            <input type="text" name="email" placeholder="E-Mail *" data-rules="required|valid_email">
          </div>
          <div class="span">
            @if ($errors->has('phone'))
              <div class="error-message is-floating">{{ $errors->first('phone') }}</div>
            @else 
              <div class="error-message is-floating" style="display:none">Telefon muss gültig sein!</div>
            @endif
            <input type="text" name="phone" placeholder="Telefon *" data-rules="required">
          </div>
          <div class="span">
            <div class="form-button">
              <input type="submit" value="Absenden" class="js-btn-submit">
            </div>
          </div>
        </div>
      </form>
    </article>
  </div>
</section>
@endsection