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
                  <ul class="list-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <li class="list-group-item title">titre du jeu</li>
                      <li class="list-group-item"><span>1</span> nom joueur 1</li>
                      <li class="list-group-item"><span>2</span> nom joueur 2</li>
                      <li class="list-group-item active"><span>3</span> nom de ton joueur</li>
                      <li class="list-group-item"><span>4</span> nom joueur 4</li>
                  </ul>
                  <ul class="list-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <li class="list-group-item title">titre du jeu</li>
                    <li class="list-group-item"><span>1</span> nom joueur 1</li>
                    <li class="list-group-item"><span>2</span> nom joueur 2</li>
                    <li class="list-group-item active"><span>3</span> nom de ton joueur</li>
                    <li class="list-group-item"><span>4</span> nom joueur 4</li>
                  </ul>
                  <ul class="list-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <li class="list-group-item title">titre du jeu</li>
                    <li class="list-group-item"><span>1</span> nom joueur 1</li>
                    <li class="list-group-item"><span>2</span> nom joueur 2</li>
                    <li class="list-group-item active"><span>3</span> nom de ton joueur</li>
                    <li class="list-group-item"><span>4</span> nom joueur 4</li>
                  </ul>
                  <ul class="list-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <li class="list-group-item title">titre du jeu</li>
                    <li class="list-group-item"><span>1</span> nom joueur 1</li>
                    <li class="list-group-item"><span>2</span> nom joueur 2</li>
                    <li class="list-group-item active"><span>3</span> nom de ton joueur</li>
                    <li class="list-group-item"><span>4</span> nom joueur 4</li>
                  </ul>
                  <ul class="list-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <li class="list-group-item title">titre du jeu</li>
                    <li class="list-group-item"><span>1</span> nom joueur 1</li>
                    <li class="list-group-item"><span>2</span> nom joueur 2</li>
                    <li class="list-group-item active"><span>3</span> nom de ton joueur</li>
                    <li class="list-group-item"><span>4</span> nom joueur 4</li>
                  </ul>
              </div>
              <div role="tabpanel" class="tab-pane row" id="profile">
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              <h3 class="panel-title">Paris - France (pays)</h3>
                          </div>
                          <div class="panel-body">
                              <img src="{{ URL::asset('images/cartes-france.jpg') }}" alt='Image de jeu'>
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam dui sapien, viverra a pulvinar vel, lacinia in orci. Proin id mi tempor, facilisis lacus eget, porttitor massa.</p>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              <h3 class="panel-title">New-York - Etats-Unis (pays)</h3>
                          </div>
                          <div class="panel-body">
                              <img src="{{ URL::asset('images/cartes-usa.jpg') }}" alt='Image de jeu'>
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam dui sapien, viverra a pulvinar vel, lacinia in orci. Proin id mi tempor, facilisis lacus eget, porttitor massa.</p>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                   <div class="panel panel-default">
                      <div class="panel-heading">
                          <h3 class="panel-title">Rome - Italie (pays)</h3>
                      </div>
                      <div class="panel-body">
                          <img src="{{ URL::asset('images/cartes-italie.jpg') }}" alt='Image de jeu'>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam dui sapien, viverra a pulvinar vel, lacinia in orci. Proin id mi tempor, facilisis lacus eget, porttitor massa.</p>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                   <div class="panel panel-default">
                      <div class="panel-heading">
                          <h3 class="panel-title">Londres - Royaume-Uni (pays)</h3>
                      </div>
                      <div class="panel-body">
                          <img src="{{ URL::asset('images/cartes-royaume-uni.jpg') }}" alt='Image de jeu'>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam dui sapien, viverra a pulvinar vel, lacinia in orci. Proin id mi tempor, facilisis lacus eget, porttitor massa.</p>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                   <div class="panel panel-default">
                      <div class="panel-heading">
                          <h3 class="panel-title">Moscou - Russie (pays)</h3>
                      </div>
                      <div class="panel-body">
                          <img src="{{ URL::asset('images/cartes-russie.jpg') }}" alt='Image de jeu'>
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
