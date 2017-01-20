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
      <?php
      $email_value = '';
      $name_value = '';
      ?>
      {!! Form::open(['url' => route('post_contact') ]) !!}

      <div class="form-group col-xs-12">
        <?php
          if(Auth::check())
          $name_value = Auth::user()->name;
        ?>
        {!! Form::label('name', 'Votre pseudo') !!}
        {!! Form::text('name', $name_value, [
          'class' => 'form-control',
          'placeholder' => 'Votre message...',
          'id'=>'name',
          ($name_value !== '') ? 'readonly' : ''
          ]) !!}
      </div>

      <div class="form-group col-xs-12">
        <?php
          if(Auth::check())
          $email_value = Auth::user()->email;
        ?>
        {!! Form::label('email', 'Votre adresse email') !!}
        {!! Form::text('email', $email_value, [
          'class' => 'form-control',
          'placeholder' => 'Votre message...',
          'id'=>'email',
          ($email_value !== '') ? 'readonly' : ''
          ]) !!}
        </div>

        <div class="form-group col-xs-12">
          {!! Form::label('contact_message', 'Votre message') !!}
          {!! Form::textarea('contact_message', '', ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Votre message...', 'id'=>'message']) !!}
        </div>

        {!! Form::submit('Envoyer votre message', ['class' => 'btn btn-default']) !!}
        {!! Form::close() !!}
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
