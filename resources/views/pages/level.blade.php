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


  <main id="level" class="container">
      <div class="col-xs-12">
          <h2>Jeux pour les {{ $level }}</h2>
      </div>

      <div class="col-xs-12 jeu-cp">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="row">
                  <img src="http://lorempicsum.com/simpsons/627/200/3" alt="Image du jeu">
              </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="row">
                  <div class="bloc">
                      <h3>Titre du jeu numéro 1</h3>
                      <div class="space"></div>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id urna id arcu pharetra sagittis id eget augue. Mauris consectetur pretium risus. Integer ullamcorper non velit eget posuere.</p>
                      <a href="{{ route('jeu', ['level'=>$level, 'game'=>'game 1']) }}" class="btn">Jouer !</a>
                  </div>
              </div>
          </div>
      </div>

      <div class="col-xs-12">
          <div class="espacement"></div>
      </div>

      <div class="col-xs-12 jeu-cp">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="row">
                  <img src="http://lorempicsum.com/simpsons/627/200/3" alt="Image du jeu">
              </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="row">
                  <div class="bloc">
                      <h3>Titre du jeu numéro 1</h3>
                      <div class="space"></div>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id urna id arcu pharetra sagittis id eget augue. Mauris consectetur pretium risus. Integer ullamcorper non velit eget posuere.</p>
                      <a href="{{ route('jeu', ['level'=>$level, 'game'=>'game 2']) }}" class="btn">Jouer !</a>
                  </div>
              </div>
          </div>
      </div>

      <div class="col-xs-12">
          <div class="espacement"></div>
      </div>

      <div class="col-xs-12 jeu-cp">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="row">
                  <img src="http://lorempicsum.com/simpsons/627/200/3" alt="Image du jeu">
              </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="row">
                  <div class="bloc">
                      <h3>Titre du jeu numéro 1</h3>
                      <div class="space"></div>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id urna id arcu pharetra sagittis id eget augue. Mauris consectetur pretium risus. Integer ullamcorper non velit eget posuere.</p>
                      <a href="{{ route('jeu', ['level'=>$level, 'game'=>'game 3']) }}" class="btn">Jouer !</a>
                  </div>
              </div>
          </div>
      </div>
  </main>
@endsection
