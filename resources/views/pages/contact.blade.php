@extends('layouts.master')

@section('title', 'Educa - Contact')

@section('content')
  <div class="container">
      <div class="col-lg-5">
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('accueil') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Contact</li>
          </ol>
      </div>
  </div>


  <main id="contact" class="container">
      <div class="col-xs-12">
          <h2>Formulaire de contact</h2>
      </div>
      <form>
          <div class="form-group col-sm-6 col-xs-12">
              <label for="name">Votre nom</label>
              <input type="text" class="form-control" id="name" placeholder="Votre nom...">
          </div>
          <div class="form-group col-sm-6 col-xs-12">
              <label for="firstname">Votre prénom</label>
              <input type="text" class="form-control" id="firstname" placeholder="Votre prénom...">
          </div>
          <div class="form-group col-xs-12">
              <label for="email">Votre adresse email</label>
              <input type="email" class="form-control" id="email" placeholder="Votre adresse email...">
          </div>
          <div class="form-group col-xs-12">
              <label for="message">Votre message</label>
              <textarea class="form-control" rows="3" id="message" placeholder="Votre message..."></textarea>
          </div>
          <button type="submit" class="btn btn-default">Envoyer votre message</button>
      </form>
  </main>
@endsection

@section('script')
  <script src="{{ URL::asset('js/easing.js') }}"></script>

  <script>
      $(function() {
          $('.nav-pills li a').bind('click', function(event) {
              var $anchor = $(this);
              $('html, body').stop().animate({
                  scrollTop: $($anchor.attr('href')).offset().top
              }, 1500, 'easeInOutExpo');
              event.preventDefault();
          });
      });
  </script>
@endsection
