@extends('layouts.master')

@section('title', 'Educa - Scores' )

@section('content')
  <div class="container">
      <div class="col-lg-5">
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('accueil') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Mes scores</li>
          </ol>
      </div>
  </div>


  <main id="score" class="container">
      <div class="col-xs-12">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Mes classements</a></li>
              <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Mes récompenses</a></li>
          </ul>

          <!-- Tab panes -->
          <div class="col-xs-12 tab-content">
              <div role="tabpanel" class="tab-pane active row" id="home">
                  <div class="list-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <a href="#" class="list-group-item title">titre du jeu</a>
                      <a href="#" class="list-group-item"><span>1</span> nom joueur 1</a>
                      <a href="#" class="list-group-item"><span>2</span> nom joueur 2</a>
                      <a href="#" class="list-group-item active"><span>3</span> nom de ton joueur</a>
                      <a href="#" class="list-group-item"><span>4</span> nom joueur 4</a>
                  </div>
                  <div class="list-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <a href="#" class="list-group-item title">titre du jeu</a>
                      <a href="#" class="list-group-item"><span>1</span> nom joueur 1</a>
                      <a href="#" class="list-group-item"><span>2</span> nom joueur 2</a>
                      <a href="#" class="list-group-item"><span>3</span> nom joueur 4</a>
                      <a href="#" class="list-group-item active"><span>4</span> nom de ton joueur</a>
                  </div>
                  <div class="list-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <a href="#" class="list-group-item title">titre du jeu</a>
                      <a href="#" class="list-group-item"><span>1</span> nom joueur 1</a>
                      <a href="#" class="list-group-item"><span>2</span> nom joueur 2</a>
                      <a href="#" class="list-group-item active"><span>3</span> nom de ton joueur</a>
                      <a href="#" class="list-group-item"><span>4</span> nom joueur 4</a>
                  </div>
                  <div class="list-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <a href="#" class="list-group-item title">titre du jeu</a>
                      <a href="#" class="list-group-item"><span>1</span> nom joueur 1</a>
                      <a href="#" class="list-group-item"><span>2</span> nom joueur 2</a>
                      <a href="#" class="list-group-item active"><span>3</span> nom de ton joueur</a>
                      <a href="#" class="list-group-item"><span>4</span> nom joueur 4</a>
                  </div>
                  <div class="list-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <a href="#" class="list-group-item title">titre du jeu</a>
                      <a href="#" class="list-group-item"><span>1</span> nom joueur 1</a>
                      <a href="#" class="list-group-item"><span>2</span> nom joueur 2</a>
                      <a href="#" class="list-group-item active"><span>3</span> nom de ton joueur</a>
                      <a href="#" class="list-group-item"><span>4</span> nom joueur 4</a>
                  </div>
              </div>
              <div role="tabpanel" class="tab-pane row" id="profile">
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              <h3 class="panel-title">nom de la carte 1</h3>
                          </div>
                          <div class="panel-body">
                              <img src="http://lorempicsum.com/futurama/350/200/1" alt='Image de jeu'>
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam dui sapien, viverra a pulvinar vel, lacinia in orci. Proin id mi tempor, facilisis lacus eget, porttitor massa.</p>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              <h3 class="panel-title">nom de la carte 1</h3>
                          </div>
                          <div class="panel-body">
                              <img src="http://lorempicsum.com/futurama/350/200/1" alt='Image de jeu'>
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam dui sapien, viverra a pulvinar vel, lacinia in orci. Proin id mi tempor, facilisis lacus eget, porttitor massa.</p>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                   <div class="panel panel-default">
                      <div class="panel-heading">
                          <h3 class="panel-title">nom de la carte 1</h3>
                      </div>
                      <div class="panel-body">
                          <img src="http://lorempicsum.com/futurama/350/200/1" alt='Image de jeu'>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam dui sapien, viverra a pulvinar vel, lacinia in orci. Proin id mi tempor, facilisis lacus eget, porttitor massa.</p>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                   <div class="panel panel-default">
                      <div class="panel-heading">
                          <h3 class="panel-title">nom de la carte 1</h3>
                      </div>
                      <div class="panel-body">
                          <img src="http://lorempicsum.com/futurama/350/200/1" alt='Image de jeu'>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam dui sapien, viverra a pulvinar vel, lacinia in orci. Proin id mi tempor, facilisis lacus eget, porttitor massa.</p>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                   <div class="panel panel-default">
                      <div class="panel-heading">
                          <h3 class="panel-title">nom de la carte 1</h3>
                      </div>
                      <div class="panel-body">
                          <img src="http://lorempicsum.com/futurama/350/200/1" alt='Image de jeu'>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam dui sapien, viverra a pulvinar vel, lacinia in orci. Proin id mi tempor, facilisis lacus eget, porttitor massa.</p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  </main>
@endsection

@section('script')
  <script src="{{ URL::asset('js/easingjs') }}"></script>
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
