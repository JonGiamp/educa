@extends('layouts.master')

@section('title', 'Educa - '.$level.'' )

@section('content')
  <div class="container">
      <div class="col-lg-5">
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('accueil') }}">Accueil</a></li>
              <li class="breadcrumb-item active">{{ $level }}</li>
          </ol>
      </div>
  </div>

<?php $first = true; ?>
  <main id="level" class="container">
      <div class="col-xs-12">
          <h2>Jeux pour les {{ $level }}</h2>
      </div>
      @foreach($games as $game)

        @if(!$first)
          <div class="col-xs-12">
              <div class="espacement"></div>
          </div>
        @endif

        <div class="col-xs-12 jeu-cp">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="row">
                  <a href="{{ route('jeu_from_level', [
                  'level'=>$level,
                  'matieres'=>$game->theme,
                  'id'=>$game->id_game,
                  'game'=>$game->game_name
                  ]) }}">
                    <img src="{{ URL::asset('images/games/'.$game->picture_url.'.png') }}" alt="Image du jeu" class="game-image">
                  </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="row">
                    <div class="bloc">
                        <h3>{{$game->game_name}}</h3>
                        <div class="space"></div>
                        <p>{{$game->game_description}}</p>
                        <a href="{{ route('jeu_from_level', [
                        'level'=>$level,
                        'matieres'=>$game->theme,
                        'id'=>$game->id_game,
                        'game'=>$game->game_name
                        ]) }}" class="btn">Jouer !</a>
                    </div>
                </div>
            </div>
        </div>
        <?php $first = false; ?>
      @endforeach
  </main>
@endsection
