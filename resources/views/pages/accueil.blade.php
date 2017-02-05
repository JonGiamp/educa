@extends('layouts.master')

@section('title', 'Educa - Accueil')

  @section('content')
    <?php
    $userYear = '';
    function checkYears($year, $userYear)
    {
      if($year == $userYear)
        echo 'style="border: 8px solid #FF9136;"';
    }
    ?>
    @if (Auth::check())
      <?php
      $userYear = strtolower(Auth::user()->years);
      ?>
    @endif
    <section>
      <div id="owl-demo" class="owl-carousel owl-theme">
        <div class="item">
          <img src="{{ URL::asset('images/slider/slider_francais.jpg') }}">
          <div class="caption">
            <div class="container">
              <div class="col-lg-12">
                <h3>Devenez un as de l'école</h3>
                <p>Les nombreux jeux proposés sur la plate-forme vous procuront tout le plaisir
                  de jouer tout en vous faisant apprendre de nouvelles choses !
                  Amusez-vous à surclasser vos amis ! </p>
                  <a href="{{ route('jeux', ['matieres' => 'francais']) }}" class="btn">Voir les jeux de Français</a>
                </div>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="{{ URL::asset('images/slider/slider_sciences.jpg') }}">
            <div class="caption">
              <div class="container">
                <div class="col-lg-12">
                  <h3>Devenez un as de l'école</h3>
                  <p>Les nombreux jeux proposés sur la plate-forme vous procuront tout le plaisir
                    de jouer tout en vous faisant apprendre de nouvelles choses !
                    Amusez-vous à surclasser vos amis ! </p>
                    <a href="{{ route('jeux', ['matieres' => 'sciences']) }}" class="btn">Voir les jeux de Sciences</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <img src="{{ URL::asset('images/slider/slider_maths.jpg') }}">
              <div class="caption">
                <div class="container">
                  <div class="col-lg-12">
                    <h3>Devenez un as de l'école</h3>
                    <p>Les nombreux jeux proposés sur la plate-forme vous procuront tout le plaisir
                      de jouer tout en vous faisant apprendre de nouvelles choses !
                      Amusez-vous à surclasser vos amis ! </p>
                      <a href="{{ route('jeux', ['matieres' => 'mathematiques']) }}" class="btn">Voir les jeux de Mathématiques</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <main>
            <section id="pub_game" class="container">
              <h1 class="text-center">Les meilleurs jeux pour apprendre !</h1>
              <article class="col-lg-12 col-md-12 col-sm-12 hidden-xs">
                <img
                src="{{ URL::asset('images/games/'.$game_spotlight->picture_url.'_spotlight.png') }}"
                alt="Image du jeu" class="image-main-slider" >
                <div class="caption">
                  <div class="container">
                    <div class="col-lg-12">
                      <h3>Découvrez notre dernier jeu</h3>
                      <div class="space"></div>
                      {{-- <a href="{{ route('jeu', ['level'=>'ce1', 'game'=>'game 1']) }}" class="btn">Jouer</a> --}}
                      <!-- CHANGE LEVEL HERE -->

                      <a href="{{ route('jeu_from_matieres', [
                        'matieres'=>$game_spotlight->theme,
                        'level'=>'CE1',
                        'id'=>$game_spotlight->id_game,
                        'game'=>$game_spotlight->game_name
                        ]) }}" class="btn">Jouer !</a>
                    </div>
                  </div>
                </div>
              </article>
              <?php
              $count_top = 1;
              $level_available = array("cp","ce1","ce2","cm1","cm2");
              $has_level = false;
              ?>
              @foreach ($games_top as $game)
                <?php $i = -1; ?>
                <article class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                  <img src="{{ URL::asset('images/games/'.$game->picture_url.'_top.png') }}" alt="Image du jeu">
                  <div class="caption">
                    <div class="container">
                      <div class="col-lg-12">
                        <h3>Top <?php echo $count_top; $count_top++; ?> de nos jeux</h3>
                        <div class="space"></div>
                        <?php
                        while (!$has_level) {
                          $i++;
                          if($game[strtoupper($level_available[$i])."_available"]) {
                            $has_level = !$has_level;
                          }
                        }
                        $has_level = !$has_level;
                        ?>
                        <a href="{{ route('jeu_from_matieres', [
                          'matieres'=>$game->theme,
                          'level'=>$level_available[$i],
                          'id'=>$game->id_game,
                          'game'=>$game->game_name
                          ]) }}" class="btn">Jouer !</a>
                      </div>
                    </div>
                  </div>
                </article>
              @endforeach
            </section>

            <section id="niveaux" class="container">
              <h1 class="text-center">En quelle classe es-tu ?</h1>
              <div class="cp">
                <a href="{{ route('niveaux', ['level' => 'cp']) }}">
                  <div class="caption img-cp" <?php checkYears('cp', $userYear) ?>>
                    <h3>CP</h3>
                  </div>
                </a>
              </div>
              <div class="ce1">
                <a href="{{ route('niveaux', ['level' => 'ce1']) }}">
                  <div class="caption img-ce1" <?php checkYears('ce1', $userYear) ?>>
                    <h3>CE1</h3>
                  </div>
                </a>
              </div>
              <div class="ce2">
                <a href="{{ route('niveaux', ['level' => 'ce2']) }}">
                  <div class="caption img-ce2" <?php checkYears('ce2', $userYear) ?>>
                    <h3>CE2</h3>
                  </div>
                </a>
              </div>
              <div class="cm1">
                <a href="{{ route('niveaux', ['level' => 'cm1']) }}">
                  <div class="caption img-cm1" <?php checkYears('cm1', $userYear) ?>>
                    <h3>CM1</h3>
                  </div>
                </a>
              </div>
              <div class="cm2">
                <a href="{{ route('niveaux', ['level' => 'cm2']) }}">
                  <div class="caption img-cm2" <?php checkYears('cm2', $userYear) ?>>
                    <h3>CM2</h3>
                  </div>
                </a>
              </div>
            </section>
          </main>
        @endsection

        @section('script')
          <script type="text/javascript">
          $(document).ready(function() {
            $("#owl-demo").owlCarousel({
              navigation : false,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem:true,
              itemsDesktop : false
            });
          });
          </script>
        @endsection
