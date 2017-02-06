@extends('layouts.master')

@section('title', 'Educa - Scores' )

@section('content')
  <?php
    function checkName($name)
    {
      if(strtolower($name) == strtolower(Auth::user()->name)) {
        echo 'active';
      }
    }
  ?>

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
              <li role="presentation"><a href="#rewards" aria-controls="rewards" role="tab" data-toggle="tab">Mes récompenses</a></li>
          </ul>

          <!-- Tab panes -->
          <div class="col-xs-12 tab-content">
            <!-- Ranking tab -->
              <div role="tabpanel" class="tab-pane active row" id="home">
                @foreach ($games_ranking as $rank)
                  <ul class="list-group col-sm-4 col-xs-12">
                      <li class="list-group-item title">{{$rank[0]->game_name}}</li>
                      @foreach ($rank as $player)
                      <li class="list-group-item <?php checkName($player->user_name) ?>"><span>{{$loop->iteration}}</span>
                        {{$player->user_name}}<span style="left: auto; right: 10px;">{{$player->user_score}}</span></li>
                      @endforeach
                  </ul>
                  @endforeach
              </div>
              <!-- Cards tab -->
              <div role="tabpanel" class="tab-pane row" id="rewards">
                @foreach ($user_cards as $user_card)
                  <div class="col-sm-4 col-xs-12">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              <h3 class="panel-title">{{$user_card[0]->card_name}} ({{$user_card[0]->category_name}})</h3>
                          </div>
                          <div class="panel-body">
                              <img src="{{ URL::asset('images/cards/'.$user_card[0]->url_image.'.jpg') }}" alt='Image de jeu'>
                              <p>{{$user_card[0]->card_description}}</p>
                          </div>
                      </div>
                  </div>
                @endforeach
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
