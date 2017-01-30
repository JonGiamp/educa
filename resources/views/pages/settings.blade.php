@extends('layouts.master')

@section('title', 'Educa - Paramètres')

  @section('content')
    <?php
    function checkYears($years) {
      if($years !== Auth::user()->years)
        return 0;
      return 1;
    }

    function checkAvatar($avatar) {
      if($avatar !== Auth::user()->avatar)
        return 0;
      return 1;
    }
    ?>
    <style media="screen">
      .avatar_preview {
        width: 50px;
        height: 50px;
        background-color: #FF9136;
        display: inline-block;
        margin-right: 30px;
      }
    </style>
    <div class="container">
      <div class="col-lg-5">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('accueil') }}">Accueil</a></li>
          <li class="breadcrumb-item active">Paramètres</li>
        </ol>
      </div>
    </div>


    <main id="single" class="container">
      <div class="col-xs-12">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Mes commentaires</a></li>
          <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Mes paramètres</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="col-xs-12 tab-content settings">
          <div role="tabpanel" class="tab-pane active row" id="home">
            <div class="commentaires col-xs-12">
              <h3>Les commentaires</h3>
              <div class="comments">

                @foreach ($user_comments as $comment)
                  <div class="comments-item row">
                    <div class="col-sm-3 col-xs-12 image">
                      <img src="{{ URL::asset('images/games/'.$comment->game_picture.'.png') }}" alt="" class="img-responsive" />
                    </div>
                    <div class="col-sm-1 col-xs-2 smiley">
                      <img src="{{ URL::asset('images/emotes/'.$comment->url_emote.'.png') }}" alt="image de profil" class="img-responsive" />
                    </div>
                    <div class="col-sm-8 col-xs-10 texte">
                      <h4>{{$comment->game_name}} | {{$comment->user_name}} <span class="date">{{$comment->date}}</span></h4>
                      <p>{{$comment->comment}}</p>
                    </div>
                  </div>
                @endforeach

              </div>
            </div>
          </div>
          <div role="tabpanel" class="tab-pane row" id="profile">
            {!! Form::open(['url' => route('options'), 'method' => 'PUT' ]) !!}
            <div class="form-group col-lg-12">
              {!! Form::label('pseudo', 'Votre pseudo') !!}
              {!! Form::text('pseudo', Auth::user()->name, [
                'class' => 'form-control',
                'placeholder' => 'Pseudonyme',
                'id'=>'pseudo',
                'readonly'
                ]) !!}
              </div>
              <div class="form-group col-lg-12">
                {!! Form::label('email', 'Votre adresse email') !!}
                {!! Form::text('email', Auth::user()->email, [
                  'class' => 'form-control',
                  'placeholder' => 'L\'adresse mail',
                  'id'=>'email'
                  ]) !!}
                </div>

                <div class="form-group col-lg-12">
                  {!! Form::label('avatar', 'Je choisis mon avatar') !!}
                  <div class="form-group radio">
                    <label class="radio-inline">
                      {!! Form::radio('avatar', "bird", checkAvatar("bird"), ['class' => 'field']) !!}
                    </label>
                        <img src="{{ URL::asset('images/avatar/avatar_bird.svg') }}" alt="bird" class="img-responsive avatar_preview" />
                    <label class="radio-inline">
                      {!! Form::radio('avatar', "cat", checkAvatar("cat"), ['class' => 'field']) !!}
                    </label>
                        <img src="{{ URL::asset('images/avatar/avatar_cat.svg') }}" alt="cat" class="img-responsive avatar_preview" />
                    <label class="radio-inline">
                      {!! Form::radio('avatar', "dog", checkAvatar("dog"), ['class' => 'field']) !!}
                    </label>
                        <img src="{{ URL::asset('images/avatar/avatar_dog.svg') }}" alt="dog" class="img-responsive avatar_preview" />
                    <label class="radio-inline">
                      {!! Form::radio('avatar', "lions", checkAvatar("lions"), ['class' => 'field']) !!}
                    </label>
                        <img src="{{ URL::asset('images/avatar/avatar_lions.svg') }}" alt="lions" class="img-responsive avatar_preview" />
                    <label class="radio-inline">
                      {!! Form::radio('avatar', "monkey", checkAvatar("monkey"), ['class' => 'field']) !!}
                    </label>
                        <img src="{{ URL::asset('images/avatar/avatar_monkey.svg') }}" alt="monkey" class="img-responsive avatar_preview" />
                    <label class="radio-inline">
                      {!! Form::radio('avatar', "phoque", checkAvatar("phoque"), ['class' => 'field']) !!}
                    </label>
                        <img src="{{ URL::asset('images/avatar/avatar_phoque.svg') }}" alt="phoque" class="img-responsive avatar_preview" />
                  </div>
                </div>

                <div class="form-group col-lg-12">
                  {!! Form::label('years', 'Je choisis ma classe ?') !!}
                  <div class="form-group radio">
                    <label class="radio-inline">
                      {!! Form::radio('years', "cp", checkYears("cp"), ['class' => 'field', 'id'=>'inlineRadio1']) !!} CP
                    </label>
                    <label class="radio-inline">
                      {!! Form::radio('years', "ce1", checkYears("ce1"), ['class' => 'field', 'id'=>'inlineRadio2']) !!} CE1
                    </label>
                    <label class="radio-inline">
                      {!! Form::radio('years', "ce2", checkYears("ce2"), ['class' => 'field', 'id'=>'inlineRadio3']) !!} CE2
                    </label>
                    <label class="radio-inline">
                      {!! Form::radio('years', "cm1", checkYears("cm1"), ['class' => 'field', 'id'=>'inlineRadio4']) !!} CM1
                    </label>
                    <label class="radio-inline">
                      {!! Form::radio('years', "cm2", checkYears("cm2"), ['class' => 'field', 'id'=>'inlineRadio5']) !!} CM2
                    </label>
                  </div>
                </div>
                <div class="form-group col-lg-12">
                  {!! Form::label('password', 'Mot de passe actuel') !!}
                  {!! Form::password('password', ['class' => 'form-control', 'id'=>'password']) !!}
                </div>
                <div class="form-group col-lg-12">
                  {!! Form::label('new_password', 'Votre nouveau mot de passe') !!}
                  {!! Form::password('new_password', ['class' => 'form-control', 'id'=>'password_1']) !!}
                </div>
                <div class="form-group col-lg-12">
                  {!! Form::label('new_password_confirmation', 'Retapez le nouveau mot de passe') !!}
                  {!! Form::password('new_password_confirmation', ['class' => 'form-control', 'id'=>'password_2']) !!}
                </div>
                <div class="form-group col-lg-12">
                  {!! Form::submit('Mettre à jour mon compte', ['class' => 'btn btn-default']) !!}
                </div>
                {!! Form::close() !!}
              </div>
            </div>
          </div>
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
