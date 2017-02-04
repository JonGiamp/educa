@extends('layouts.master')

@section('title', 'Educa - '.$matieres.'' )

  @section('content')
    <?php
    $check = true;
    $level_available = array("cp","ce1","ce2","cm1","cm2");
    ?>
    <div class="container">
      <div class="col-lg-5">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('accueil') }}">Accueil</a></li>
          <li class="breadcrumb-item active">{{ $matieres }}</li>
        </ol>
      </div>
    </div>


    <main id="level" class="container">
      <div class="col-xs-12">
        <h2>{{ $matieres }}</h2>
        <div class="table">
          <ul id="horizontal-list" class="nav nav-pills">
            @foreach ($level_available as $level)
              <li role="presentation"><a href="#{{$level}}">{{strtoupper($level)}}</a></li>
            @endforeach
          </ul>
        </div>
      </div>

      @foreach ($level_available as $level)
        @foreach ($games as $game)
          <div class="col-xs-12 jeu-cp" id="{{$level}}">
            @if($check)
              <h4>Les jeux pour les {{strtoupper($level)}}</h4>
              <?php $check = !$check; ?>
            @endif
            @if ($game[strtoupper($level)."_available"])
              <div class="col-sm-6 col-xs-12">
                <div class="row">
                  <a href="{{ route('jeu_from_matieres', [
                    'matieres'=>$game->theme,
                    'level'=>$level,
                    'id'=>$game->id_game,
                    'game'=>$game->game_name
                    ]) }}">
                    <img src="{{ URL::asset('images/games/'.$game->picture_url.'.png') }}" alt="image de jeu">
                  </a>
                </div>
              </div>
              <div class="col-sm-6 col-xs-12">
                <div class="row">
                  <div class="bloc">
                    <h3>{{$game->game_name}}</h3>
                    <div class="space"></div>
                    <p>{{$game->game_description}}</p>
                    {{-- <a href="{{ route('jeu', ['level'=>$level, 'game'=>$game->game_name]) }}" class="btn">Jouer !</a> --}}
                    <a href="{{ route('jeu_from_matieres', [
                      'matieres'=>$game->theme,
                      'level'=>$level,
                      'id'=>$game->id_game,
                      'game'=>$game->game_name
                      ]) }}" class="btn">Jouer !</a>
                  </div>
                </div>
              </div>
            @endif
          </div>
        @endforeach
        <?php $check = !$check; ?>
        @if($level != 'cm2')
          <div class="col-xs-12">
            <div class="espacement"></div>
          </div>
        @endif
      @endforeach
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
        //event.preventDefault();
      });
    });
    </script>
  @endsection
