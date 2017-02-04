@extends('layouts.master')

@section('title', 'Educa - '.$game->game_name.' - '.$level.'' )

{{-- @section('headgames')
  @if($game->game_url !== "undefined")
      <link rel="manifest" href="{{ URL::asset('js/games/'.strtolower($game->game_name).'/manifest.json') }}">
      <link rel="stylesheet" type="text/css" media="screen" href="{{ URL::asset('js/games/'.strtolower($game->game_name).'/index.css') }}">
      <meta id="viewport" name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  @else
    <script type="text/javascript">
      console.log("toto");
    </script>
  @endif
@endsection --}}

@section('content')
  <?php
    $user_nickname = '';
    $user_id = '';
    function checkName($name, $user_nickname)
    {
      if(strtolower($name) == $user_nickname)
        echo 'active';
    }
  ?>
  @if(Auth::check())
    <?php
      $user_nickname = strtolower(Auth::user()->name);
      $user_id = strtolower(Auth::user()->id);
    ?>
  @endif
  <div class="container">
      <div class="col-lg-5">
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('accueil') }}">Accueil</a></li>
              <li class="breadcrumb-item"><a href="{{ route('niveaux', ['level' => $level ]) }}">{{ $level }}</a></li>
              <li class="breadcrumb-item active">{{ $game->game_name }}</li>
          </ol>
      </div>
  </div>


  <main id="single" class="container">
      <div class="col-xs-12 jeux">
          <h4>{{ $game->game_name }}</h4>
          <div class="col-sm-8 col-xs-12">
              <div class="row" id="screen">
                {{-- @if($game->game_url === "undefined") --}}
                  <img src="{{ URL::asset('images/games/'.$game->picture_url.'.png') }}" alt="image du jeu">
                  <a href="#collapseExample" class="btn btn-action" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample">C'est quoi ce jeu ?</a>
                {{-- @endif --}}
              </div>
              <div class="collapse" id="collapseExample">
                  <div class="well">
                      <p>{{ $game->game_notice }}</p>
                  </div>
              </div>
              @if($game->game_url !== "undefined")
                <button type="button" name="button" onclick="ouvre_popup('{{ URL::asset('js/games/'.$game->picture_url.'/index.html?idg='.$game->id_game.'&amp;idu='.$user_id.'&amp;gnme='.$game->game_name.'&amp;glvl='.$level.'&amp;uname='.$user_nickname.'&amp;token='.csrf_token()
                  ) }}')">Open game</button>
              @endif
          </div>
          <div class="col-sm-4 col-xs-12">
              <div class="row">
                  <div class="bloc">
                      <ul class="list-group">
                          <li class="list-group-item title">classement</a>
                          @if(count($game_rank) != 0)
                            @foreach ($game_rank as $player)
                            <li class="list-group-item <?php checkName($player->user_name,$user_nickname) ?>"><span>{{strtoupper($player->game_level)}}</span>
                              {{$player->user_name}}<span style="left: auto; right: 10px;">{{$player->user_score}}</span></li>
                            @endforeach
                          @else
                            <li class="list-group-item">Le classement est actuellement vide, profite en !</li>
                          @endif
                      </ul>
                      @if(count($game_rank) != 0)
                        <a href="{{ route('scores') }}" class="btn">Voir le classement complet</a>
                      @endif
                  </div>
              </div>
          </div>
          <div class="commentaires col-xs-12">
              <h3>Les commentaires</h3>
              <div class="comments">
                @foreach($game_comments as $comment)
                  <div class="comments-item row">
                      <div class="col-sm-3 col-xs-12 image">
                          <img src="{{ URL::asset('images/games/'.$comment->game_picture.'.png') }}" alt="{{$comment->url_emote}}" class="img-responsive" />
                      </div>
                      <div class="col-sm-1 col-xs-2 smiley">
                          <img src="{{ URL::asset('images/emotes/'.$comment->url_emote.'.png') }}" alt="" class="img-responsive" />
                      </div>
                      <div class="col-sm-8 col-xs-10 texte">
                          <h4>{{$comment->user_name}} <span class="date">{{$comment->date}}</span></h4>
                          <p>{{$comment->comment}}</p>
                      </div>
                  </div>
                @endforeach
              </div>
          </div>

        @if(Auth::check())
          <div class="commentaires write col-xs-12">
              <h3>Ecrire un commentaire</h3>
              <div class="comments">
                  <div class="comments-item row">
                      <div class="col-sm-3 col-xs-12 image">
                          <img src="{{ URL::asset('images/games/'.$comment->game_picture.'.png') }}" alt="{{$comment->url_emote}}" class="img-responsive" />
                      </div>

                        {!! Form::open(['url' => route('post_comments') ]) !!}
                        {!! Form::hidden('id_game', $game->id_game); !!}
                        {!! Form::hidden('game_name', $game->game_name); !!}
                        {!! Form::hidden('game_picture', $game->picture_url); !!}

                        {!! Form::hidden('level', $level); !!}

                        {!! Form::hidden('matieres', $game->theme); !!}

                        <div class="col-sm-1 col-xs-2 smiley">
                            <img src="{{ URL::asset('images/emotes/happy.png') }}" alt="happy" class="img-responsive" id="emoteContainer"/>
                        </div>
                        <div class="col-sm-8 col-xs-10 texte">
                            <h4>{{Auth::user()->name}} <span class="date"><?php echo date('Y-m-d') ?></span></h4>
                            {!! Form::textarea('comment', '', ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Ecrire le commentaire...']) !!}
                            <div class="avis col-sm-6 col-xs-12">
                              {!! Form::radio('url_emote', "love", 0, ['class' => 'img-responsive avis', 'id'=>'inlineRadio1', 'onclick'=>'displayEmote("love")']) !!}
                                <img src="{{ URL::asset('images/emotes/love.png') }}" alt="love" class="img-responsive avis" />
                              {!! Form::radio('url_emote', "happy", 1, ['class' => 'img-responsive avis', 'id'=>'inlineRadio1', 'onclick'=>'displayEmote("happy")']) !!}
                                <img src="{{ URL::asset('images/emotes/happy.png') }}" alt="happy" class="img-responsive avis" />
                              {!! Form::radio('url_emote', "smile", 0, ['class' => 'img-responsive avis', 'id'=>'inlineRadio1', 'onclick'=>'displayEmote("smile")']) !!}
                                <img src="{{ URL::asset('images/emotes/smile.png') }}" alt="smile" class="img-responsive avis" />
                              {!! Form::radio('url_emote', "sad", 0, ['class' => 'img-responsive avis', 'id'=>'inlineRadio1', 'onclick'=>'displayEmote("sad")']) !!}
                                <img src="{{ URL::asset('images/emotes/sad.png') }}" alt="sad" class="img-responsive avis" />
                              {!! Form::radio('url_emote', "cry", 0, ['class' => 'img-responsive avis', 'id'=>'inlineRadio1', 'onclick'=>'displayEmote("cry")']) !!}
                                <img src="{{ URL::asset('images/emotes/cry.png') }}" alt="cry" class="img-responsive avis" />

                            </div>
                            <div class="col-sm-6 col-xs-12">
                                {!! Form::submit('Envoyer le commentaire', ['class' => 'btn']) !!}
                            </div>
                        </div>
                        {!! Form::hidden('comeback_url', $folder.'/'.$matieres.'/'.strtolower($level).'/'.$game->id_game.'-'.$game->game_name); !!}

                      {!! Form::close() !!}

                  </div>
              </div>
          </div>
          @endif
      </div>
  </main>
@endsection

@section('script')
  <script src="{{ URL::asset('js/easing.js') }}"></script>
  <script>
    var emoteRoot = "{{ URL::asset('images/emotes') }}";
    var $emoteContainer = $("#emoteContainer");

    function displayEmote(value) {
      $emoteContainer.attr('src', emoteRoot + '/' + value + '.png');
    }

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

  {{-- @if($game->game_url !== "undefined")
    <script src="{{ URL::asset('js/games/'.strtolower($game->game_url).'/js/socket.io.min.js') }}"></script>
    <script>var imgRoot = "{{ URL::asset('images/games/'.strtolower($game->game_url).'/') }}"</script>
    <script src="{{ URL::asset('js/melonJS.js') }}"></script>
    <script src="{{ URL::asset('js/games/'.strtolower($game->game_url).'/js/main.js') }}"></script>
    <script type="text/javascript">
  		window.onReady(function onReady() {
  			game.onload(740,450,"screen");
  		});
  	</script>
  @endif --}}

  <script type="text/javascript">
    function ouvre_popup(page) {
       window.open(page,"nom_popup","menubar=no, status=no, scrollbars=no, menubar=no, width=740, height=450");
   }
  </script>

@endsection
