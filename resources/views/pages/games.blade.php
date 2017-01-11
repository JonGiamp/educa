@extends('layouts.master')

@section('title', 'Educa - '.$matieres.'' )

@section('content')
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
                  <li role="presentation"><a href="#cp">CP</a></li>
                  <li role="presentation"><a href="#ce1">CE1</a></li>
                  <li role="presentation"><a href="#ce2">CE2</a></li>
                  <li role="presentation"><a href="#cm1">CM1</a></li>
                  <li role="presentation"><a href="#cm2">CM2</a></li>
              </ul>
          </div>
      </div>

      <div class="col-xs-12 jeu-cp" id="cp">
          <h4>Les jeux pour les CP</h4>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="row">
                  <img src="http://lorempicsum.com/simpsons/627/200/3" alt="image de jeu">
              </div>
          </div>
          <div class="col-sm-6 col-xs-12">
              <div class="row">
                  <div class="bloc">
                      <h3>Titre du jeu numéro 1</h3>
                      <div class="space"></div>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id urna id arcu pharetra sagittis id eget augue. Mauris consectetur pretium risus. Integer ullamcorper non velit eget posuere.</p>
                      <a href="{{ route('jeu', ['level'=>'cp', 'game'=>'game 4']) }}" class="btn">Jouer !</a>
                  </div>
              </div>
          </div>
      </div>

      <div class="col-xs-12 jeu-cp">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="row">
                  <img src="http://lorempicsum.com/simpsons/627/200/3" alt="image de jeu">
              </div>
          </div>
          <div class="col-sm-6 col-xs-12">
              <div class="row">
                  <div class="bloc">
                      <h3>Titre du jeu numéro 1</h3>
                      <div class="space"></div>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id urna id arcu pharetra sagittis id eget augue. Mauris consectetur pretium risus. Integer ullamcorper non velit eget posuere.</p>
                      <a href="{{ route('jeu', ['level'=>'cp', 'game'=>'game 9']) }}" class="btn">Jouer !</a>
                  </div>
              </div>
          </div>
      </div>

      <div class="col-xs-12 jeu-cp">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="row">
                  <img src="http://lorempicsum.com/simpsons/627/200/2" alt="image de jeu">
              </div>
          </div>
          <div class="col-sm-6 col-xs-12">
              <div class="row">
                  <div class="bloc">
                      <h3>Titre du jeu numéro 1</h3>
                      <div class="space"></div>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id urna id arcu pharetra sagittis id eget augue. Mauris consectetur pretium risus. Integer ullamcorper non velit eget posuere.</p>
                      <a href="{{ route('jeu', ['level'=>'cp', 'game'=>'game 13']) }}" class="btn">Jouer !</a>
                  </div>
              </div>
          </div>
      </div>

      <div class="col-xs-12">
          <div id="ce1" class="espacement"></div>
      </div>

      <div class="col-xs-12 jeu-cp">
          <h4>Les jeux pour les CE1</h4>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="row">
                  <img src="http://lorempicsum.com/simpsons/627/200/4" alt="image de jeu">
              </div>
          </div>
          <div class="col-sm-6 col-xs-12">
              <div class="row">
                  <div class="bloc">
                      <h3>Titre du jeu numéro 1</h3>
                      <div class="space"></div>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id urna id arcu pharetra sagittis id eget augue. Mauris consectetur pretium risus. Integer ullamcorper non velit eget posuere.</p>
                      <a href="{{ route('jeu', ['level'=>'ce1', 'game'=>'game 4']) }}" class="btn">Jouer !</a>
                  </div>
              </div>
          </div>
      </div>

      <div class="col-xs-12 jeu-cp">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="row">
                  <img src="http://lorempicsum.com/simpsons/627/200/5" alt="image de jeu">
              </div>
          </div>
          <div class="col-sm-6 col-xs-12">
              <div class="row">
                  <div class="bloc">
                      <h3>Titre du jeu numéro 1</h3>
                      <div class="space"></div>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id urna id arcu pharetra sagittis id eget augue. Mauris consectetur pretium risus. Integer ullamcorper non velit eget posuere.</p>
                      <a href="{{ route('jeu', ['level'=>'ce1', 'game'=>'game 1']) }}" class="btn">Jouer !</a>
                  </div>
              </div>
          </div>
      </div>

      <div class="col-xs-12 jeu-cp">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="row">
                  <img src="http://lorempicsum.com/simpsons/627/200/3" alt="image de jeu">
              </div>
          </div>
          <div class="col-sm-6 col-xs-12">
              <div class="row">
                  <div class="bloc">
                      <h3>Titre du jeu numéro 1</h3>
                      <div class="space"></div>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id urna id arcu pharetra sagittis id eget augue. Mauris consectetur pretium risus. Integer ullamcorper non velit eget posuere.</p>
                      <a href="{{ route('jeu', ['level'=>'ce1', 'game'=>'game 5']) }}" class="btn">Jouer !</a>
                  </div>
              </div>
          </div>
      </div>

      <div class="col-xs-12">
          <div class="espacement" id="ce2"></div>
      </div>

      <div class="col-xs-12 jeu-cp">
          <h4>Les jeux pour les CE2</h4>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="row">
                  <img src="http://lorempicsum.com/simpsons/627/200/7" alt="image de jeu">
              </div>
          </div>
          <div class="col-sm-6 col-xs-12">
              <div class="row">
                  <div class="bloc">
                      <h3>Titre du jeu numéro 1</h3>
                      <div class="space"></div>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id urna id arcu pharetra sagittis id eget augue. Mauris consectetur pretium risus. Integer ullamcorper non velit eget posuere.</p>
                      <a href="{{ route('jeu', ['level'=>'ce2', 'game'=>'game 9']) }}" class="btn">Jouer !</a>
                  </div>
              </div>
          </div>
      </div>

      <div class="col-xs-12 jeu-cp">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="row">
                  <img src="http://lorempicsum.com/simpsons/627/200/8" alt="image de jeu">
              </div>
          </div>
          <div class="col-sm-6 col-xs-12">
              <div class="row">
                  <div class="bloc">
                      <h3>Titre du jeu numéro 1</h3>
                      <div class="space"></div>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id urna id arcu pharetra sagittis id eget augue. Mauris consectetur pretium risus. Integer ullamcorper non velit eget posuere.</p>
                      <a href="{{ route('jeu', ['level'=>'ce2', 'game'=>'game 67']) }}" class="btn">Jouer !</a>
                  </div>
              </div>
          </div>
      </div>

      <div class="col-xs-12 jeu-cp">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="row">
                  <img src="http://lorempicsum.com/simpsons/627/200/9" alt="image de jeu">
              </div>
          </div>
          <div class="col-sm-6 col-xs-12">
              <div class="row">
                  <div class="bloc">
                      <h3>Titre du jeu numéro 1</h3>
                      <div class="space"></div>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id urna id arcu pharetra sagittis id eget augue. Mauris consectetur pretium risus. Integer ullamcorper non velit eget posuere.</p>
                      <a href="{{ route('jeu', ['level'=>'ce2', 'game'=>'game 44']) }}" class="btn">Jouer !</a>
                  </div>
              </div>
          </div>
      </div>


      <div class="col-xs-12">
          <div class="espacement" id="cm1"></div>
      </div>

      <div class="col-xs-12 jeu-cp">
          <h4>Les jeux pour les CM1</h4>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="row">
                  <img src="http://lorempicsum.com/simpsons/627/200/4" alt="image de jeu">
              </div>
          </div>
          <div class="col-sm-6 col-xs-12">
              <div class="row">
                  <div class="bloc">
                      <h3>Titre du jeu numéro 1</h3>
                      <div class="space"></div>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id urna id arcu pharetra sagittis id eget augue. Mauris consectetur pretium risus. Integer ullamcorper non velit eget posuere.</p>
                      <a href="{{ route('jeu', ['level'=>'cm1', 'game'=>'game 28']) }}" class="btn">Jouer !</a>
                  </div>
              </div>
          </div>
      </div>

      <div class="col-xs-12 jeu-cp">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="row">
                  <img src="http://lorempicsum.com/simpsons/627/200/5" alt="image de jeu">
              </div>
          </div>
          <div class="col-sm-6 col-xs-12">
              <div class="row">
                  <div class="bloc">
                      <h3>Titre du jeu numéro 1</h3>
                      <div class="space"></div>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id urna id arcu pharetra sagittis id eget augue. Mauris consectetur pretium risus. Integer ullamcorper non velit eget posuere.</p>
                      <a href="{{ route('jeu', ['level'=>'cm1', 'game'=>'game 7']) }}" class="btn">Jouer !</a>
                  </div>
              </div>
          </div>
      </div>

      <div class="col-xs-12 jeu-cp">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="row">
                  <img src="http://lorempicsum.com/simpsons/627/200/6" alt="image de jeu">
              </div>
          </div>
          <div class="col-sm-6 col-xs-12">
              <div class="row">
                  <div class="bloc">
                      <h3>Titre du jeu numéro 1</h3>
                      <div class="space"></div>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id urna id arcu pharetra sagittis id eget augue. Mauris consectetur pretium risus. Integer ullamcorper non velit eget posuere.</p>
                      <a href="{{ route('jeu', ['level'=>'cm1', 'game'=>'game 9']) }}" class="btn">Jouer !</a>
                  </div>
              </div>
          </div>
      </div>

      <div class="col-xs-12">
          <div class="espacement" id="cm2"></div>
      </div>

      <div class="col-xs-12 jeu-cp">
          <h4>Les jeux pour les CM2</h4>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="row">
                  <img src="http://lorempicsum.com/simpsons/627/200/7" alt="image de jeu">
              </div>
          </div>
          <div class="col-sm-6 col-xs-12">
              <div class="row">
                  <div class="bloc">
                      <h3>Titre du jeu numéro 1</h3>
                      <div class="space"></div>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id urna id arcu pharetra sagittis id eget augue. Mauris consectetur pretium risus. Integer ullamcorper non velit eget posuere.</p>
                      <a href="{{ route('jeu', ['level'=>'cm2', 'game'=>'game 99']) }}" class="btn">Jouer !</a>
                  </div>
              </div>
          </div>
      </div>

      <div class="col-xs-12 jeu-cp">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="row">
                  <img src="http://lorempicsum.com/simpsons/627/200/8" alt="image de jeu">
              </div>
          </div>
          <div class="col-sm-6 col-xs-12">
              <div class="row">
                  <div class="bloc">
                      <h3>Titre du jeu numéro 1</h3>
                      <div class="space"></div>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id urna id arcu pharetra sagittis id eget augue. Mauris consectetur pretium risus. Integer ullamcorper non velit eget posuere.</p>
                      <a href="{{ route('jeu', ['level'=>'cm2', 'game'=>'Ceci est un jeu']) }}" class="btn">Jouer !</a>
                  </div>
              </div>
          </div>
      </div>

      <div class="col-xs-12 jeu-cp">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="row">
                  <img src="http://lorempicsum.com/simpsons/627/200/9" alt="image de jeu">
              </div>
          </div>
          <div class="col-sm-6 col-xs-12">
              <div class="row">
                  <div class="bloc">
                      <h3>Titre du jeu numéro 1</h3>
                      <div class="space"></div>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id urna id arcu pharetra sagittis id eget augue. Mauris consectetur pretium risus. Integer ullamcorper non velit eget posuere.</p>
                      <a href="{{ route('jeu', ['level'=>'cm2', 'game'=>'Je gère le PHP n\'empeche']) }}" class="btn">Jouer !</a>
                  </div>
              </div>
          </div>
      </div>

  </main>
@endsection

@section('script')
  <script src="{{ URL::asset('js/easingjs') }}"></script>
@endsection
