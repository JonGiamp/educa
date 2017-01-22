@extends('layouts.master')

@section('title', 'Educa - Connexion')

@section('content')
  <div class="container">
      <div class="col-lg-5">
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Accueil</a></li>
              <li class="breadcrumb-item active">Contact</li>
          </ol>
      </div>
  </div>


  <main id="account" class="container">
      <div class="col-xs-12">
          <h2>Il est l'heure de se lancer</h2>
      </div>
      <form class="col-sm-6 col-xs-12">
          <h3>Se connecter</h3>
          <div class="form-group col-xs-12">
              <label for="pseudo">Votre pseudo</label>
              <input type="text" class="form-control" id="pseudo" placeholder="Votre nom d'utilisateur...">
          </div>
          <div class="form-group col-xs-12">
              <label for="password_2">Votre mot de passe</label>
              <input type="password" class="form-control" id="password_2" placeholder="Votre mot de passe...">
          </div>
          <button type="submit" class="btn btn-default btn-action">Se connecter</button>

          <div class="form-group col-xs-12">
              <a class="btn btn-block btn-social btn-facebook">
                  <span class="fa fa-facebook"></span> Se connecter avec Facebook
              </a>
          </div>
          <div class="form-group col-xs-12">
              <a class="btn btn-block btn-social btn-google">
                  <span class="fa fa-google-plus"></span> Se connecter avec Google
              </a>
          </div>
      </form>
  </main>
@endsection
