@extends('layouts.master')

@section('title', 'Educa - Paramètres')

@section('content')
  <div class="container">
      <div class="col-lg-5">
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('accueil') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Paramètres</li>
          </ol>
      </div>
  </div>


  <main id="single" class="container">
      <div class="col-xs-12">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Mes commentaires</a></li>
              <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Mes paramètres</a></li>
          </ul>

          <!-- Tab panes -->
          <div class="col-xs-12 tab-content settings">
              <div role="tabpanel" class="tab-pane active row" id="home">
                  <div class="commentaires col-xs-12">
                      <h3>Les commentaires</h3>
                      <div class="comments">
                          <div class="comments-item row">
                              <div class="col-sm-3 col-xs-12 image">
                                  <img src="http://placehold.it/350x150" alt="" class="img-responsive" />
                              </div>
                              <div class="col-sm-1 col-xs-2 smiley">
                                  <img src="{{ URL::asset('images/happy.png') }}" alt="image de profil" class="img-responsive" />
                              </div>
                              <div class="col-sm-8 col-xs-10 texte">
                                  <h4>Nom du jeu | Le pseudo de l'enfant <span class="date">Date du commentaire</span></h4>
                                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id urna id arcu pharetra sagittis id eget augue. Mauris consectetur pretium risus. Integer ullamcorper non velit eget posuere.</p>
                              </div>
                          </div>
                          <div class="comments-item row">
                              <div class="col-sm-3 col-xs-12 image">
                                  <img src="http://placehold.it/350x150" alt="" class="img-responsive" />
                              </div>
                              <div class="col-sm-1 col-xs-2 smiley">
                                  <img src="{{ URL::asset('images/happy.png') }}" alt="image de profil" class="img-responsive" />
                              </div>
                              <div class="col-sm-8 col-xs-10 texte">
                                  <h4>Nom du jeu | Le pseudo de l'enfant <span class="date">Date du commentaire</span></h4>
                                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id urna id arcu pharetra sagittis id eget augue. Mauris consectetur pretium risus. Integer ullamcorper non velit eget posuere.</p>
                              </div>
                          </div>
                          <div class="comments-item row">
                              <div class="col-sm-3 col-xs-12 image">
                                  <img src="http://placehold.it/350x150" alt="" class="img-responsive" />
                              </div>
                              <div class="col-sm-1 col-xs-2 smiley">
                                  <img src="{{ URL::asset('images/happy.png') }}" alt="image de profil" class="img-responsive" />
                              </div>
                              <div class="col-sm-8 col-xs-10 texte">
                                  <h4>Nom du jeu | Le pseudo de l'enfant <span class="date">Date du commentaire</span></h4>
                                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id urna id arcu pharetra sagittis id eget augue. Mauris consectetur pretium risus. Integer ullamcorper non velit eget posuere.</p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div role="tabpanel" class="tab-pane row" id="profile">
                  <form class="col-lg-6">
                      <div class="form-group col-lg-12">
                          <label for="pseudo">Votre pseudo</label>
                          <input type="text" class="form-control" id="pseudo" placeholder="Pseudonyme">
                      </div>
                      <div class="form-group col-lg-12">
                          <label for="email">Votre adresse email</label>
                          <input type="email" class="form-control" id="email" placeholder="L'adresse mail">
                      </div>
                      <div class="form-group col-lg-12">
                          <label for="password">En quelle classe êtes-vous ?</label>
                          <div class="form-group radio">
                              <label class="radio-inline">
                                  <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> CP
                              </label>
                              <label class="radio-inline">
                                <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> CE1
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3"> CE2
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="inlineRadioOptions" id="inlineRadio4" value="option4"> CM1
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="inlineRadioOptions" id="inlineRadio5" value="option5"> CM2
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-lg-12">
                      <label for="password">Votre mot de passe Actuel</label>
                      <input type="password" class="form-control" id="password" placeholder="Votre mot de passe actuel...">
                  </div>
                  <div class="form-group col-lg-12">
                      <label for="password_1">Nouveau mot de passe</label>
                      <input type="password" class="form-control" id="password_1" placeholder="Votre mot de passe...">
                  </div>
                  <div class="form-group col-lg-12">
                      <label for="password_2">Retapez le nouveau mot de passe</label>
                      <input type="password" class="form-control" id="password_2" placeholder="Votre mot de passe...">
                  </div>
                  <div class="form-group col-lg-12">
                      <button type="submit" class="btn btn-default">Créer votre compte</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</main>
@endsection

@section('script')
  <script src="_js/easing.js"></script>

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
