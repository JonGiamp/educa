@extends('layouts.master')

@section('title', 'Educa - '.$game.' - '.$level.'' )

@section('content')
  <div class="container">
      <div class="col-lg-5">
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('accueil') }}">Accueil</a></li>
              <li class="breadcrumb-item"><a href="{{ route('niveaux', ['level' => $level ]) }}">{{ $level }}</a></li>
              <li class="breadcrumb-item active">{{ $game }}</li>
          </ol>
      </div>
  </div>


  <main id="single" class="container">
      <div class="col-xs-12 jeux">
          <h4>{{ $game }}</h4>
          <div class="col-sm-8 col-xs-12">
              <div class="row">
                  <img src="http://lorempicsum.com/simpsons/627/200/3" alt="image du jeu">
                  <a href="#collapseExample" class="btn btn-action" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample">C'est quoi ce jeu ?</a>
                  <div class="collapse" id="collapseExample">
                      <div class="well">
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id purus iaculis, fringilla magna ac, lacinia felis. Duis non lectus finibus, pellentesque nisl in, viverra ipsum. Duis et odio sed metus pharetra varius. Donec fringilla enim tincidunt massa egestas elementum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla facilisi.</p>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-sm-4 col-xs-12">
              <div class="row">
                  <div class="bloc">
                      <ul class="list-group">
                          <li class="list-group-item title">classement</a>
                          <li class="list-group-item"><span>1</span> nom joueur 1</li>
                          <li class="list-group-item"><span>2</span> nom joueur 2</li>
                          <li class="list-group-item active"><span>3</span> nom de ton joueur</li>
                          <li class="list-group-item"><span>4</span> nom joueur 4</li>
                          <li class="list-group-item"><span>5</span> nom joueur 5</li>
                          <li class="list-group-item"><span>6</span> nom joueur 6</li>
                          <li class="list-group-item"><span>7</span> nom joueur 7</li>
                          <li class="list-group-item"><span>8</span> nom joueur 8</li>
                          <li class="list-group-item"><span>9</span> nom joueur 9</li>
                          <li class="list-group-item"><span>10</span> nom joueur 10</li>
                      </ul>
                      <a href="{{ route('scores') }}" class="btn">Voir le classement complet</a>
                  </div>
              </div>
          </div>
          <div class="commentaires col-xs-12">
              <h3>Les commentaires</h3>
              <div class="comments">
                  <div class="comments-item row">
                      <div class="col-sm-3 col-xs-12 image">
                          <img src="http://placehold.it/350x150" alt="smiley" class="img-responsive" />
                      </div>
                      <div class="col-sm-1 col-xs-2 smiley">
                          <img src="{{ URL::asset('images/happy.png') }}" alt="" class="img-responsive" />
                      </div>
                      <div class="col-sm-8 col-xs-10 texte">
                          <h4>Nom de l'enfant <span class="date">12 janvier 2017</span></h4>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id urna id arcu pharetra sagittis id eget augue. Mauris consectetur pretium risus. Integer ullamcorper non velit eget posuere.</p>
                      </div>
                  </div>
                  <div class="comments-item row">
                      <div class="col-sm-3 col-xs-12 image">
                          <img src="http://placehold.it/350x150" alt="smiley" class="img-responsive" />
                      </div>
                      <div class="col-sm-1 col-xs-2 smiley">
                          <img src="{{ URL::asset('images/happy.png') }}" alt="" class="img-responsive" />
                      </div>
                      <div class="col-sm-8 col-xs-10 texte">
                          <h4>Nom de l'enfant <span class="date">12 janvier 2017</span></h4>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id urna id arcu pharetra sagittis id eget augue. Mauris consectetur pretium risus. Integer ullamcorper non velit eget posuere.</p>
                      </div>
                  </div>
                  <div class="comments-item row">
                      <div class="col-sm-3 col-xs-12 image">
                          <img src="http://placehold.it/350x150" alt="smiley" class="img-responsive" />
                      </div>
                      <div class="col-sm-1 col-xs-2 smiley">
                          <img src="{{ URL::asset('images/happy.png') }}" alt="" class="img-responsive" />
                      </div>
                      <div class="col-sm-8 col-xs-10 texte">
                          <h4>Nom de l'enfant <span class="date">12 janvier 2017</span></h4>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id urna id arcu pharetra sagittis id eget augue. Mauris consectetur pretium risus. Integer ullamcorper non velit eget posuere.</p>
                      </div>
                  </div>
              </div>
          </div>
          <div class="commentaires write col-xs-12">
              <h3>Ecrire un commentaire</h3>
              <div class="comments">
                  <div class="comments-item row">
                      <div class="col-sm-3 col-xs-12 image">
                          <img src="http://placehold.it/350x150" alt="" class="img-responsive" />
                      </div>
                      <div class="col-sm-1 col-xs-2 smiley">
                          <img src="{{ URL::asset('images/happy.png') }}" alt="smiley" class="img-responsive" />
                      </div>
                      <div class="col-sm-8 col-xs-10 texte">
                          <h4>Nom de l'enfant <span class="date">12 janvier 2017</span></h4>
                          <textarea class="form-control" rows="3" placeholder="Ecrire le commentaire..."></textarea>
                          <div class="avis col-sm-6 col-xs-12">
                              <img src="{{ URL::asset('images/happy.png') }}" alt="smiley" class="img-responsive avis" />
                              <img src="{{ URL::asset('images/happy.png') }}" alt="smiley" class="img-responsive avis" />
                              <img src="{{ URL::asset('images/happy.png') }}" alt="smiley" class="img-responsive avis" />
                              <img src="{{ URL::asset('images/happy.png') }}" alt="smiley" class="img-responsive avis" />
                              <img src="{{ URL::asset('images/happy.png') }}" alt="smiley" class="img-responsive avis" />
                          </div>
                          <div class="col-sm-6 col-xs-12">
                              <a href="#" class="btn">Envoyer le commentaire</a>
                          </div>
                      </div>
                  </div>
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
