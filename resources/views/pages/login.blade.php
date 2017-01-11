@extends('layouts.master')

@section('title', 'Educa - Connexion')

@section('content')
  <div class="container">
      <div class="col-lg-5">
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('accueil') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Contact</li>
          </ol>
      </div>
  </div>


  <main id="account" class="container">
      <div class="col-xs-12">
          <h2>Il est l'heure de se lancer</h2>
      </div>
      <form class="col-sm-6 col-xs-12">
          <h3>Créer un compte</h3>
          <div class="form-group col-xs-12">
              <label for="email">Votre adresse email</label>
              <input type="email" class="form-control" id="email" placeholder="Votre adresse email...">
          </div>
          <button type="submit" class="btn btn-default">Créer votre compte</button>
      </form>
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
          <button type="submit" class="btn btn-default">Se connecter</button>

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
      <form class="col-sm-6 col-xs-12">
          <div class="form-group col-xs-12">
              <label for="pseudo_1">Votre pseudo</label>
              <input type="text" class="form-control" id="pseudo_1" placeholder="Votre nom d'utilisateur...">
          </div>
          <div class="form-group col-xs-12">
              <label for="email_1">Votre adresse email</label>
              <input type="email" class="form-control" id="email_1" placeholder="Votre adresse email...">
          </div>
          <div class="form-group col-xs-12">
              <label for="password">Votre mot de passe</label>
              <input type="password" class="form-control" id="password" placeholder="Votre mot de passe...">
          </div>
          <div class="form-group col-xs-12">
              <label for="password_1">Retapez votre mot de passe</label>
              <input type="password" class="form-control" id="password_1" placeholder="Votre mot de passe...">
          </div>
          <button type="submit" class="btn btn-default">Créer votre compte</button>
      </form>
      <form class="col-sm-6 col-xs-12 create">
          <div class="form-group col-xs-12">
              <a class="btn btn-block btn-social btn-facebook">
                  <span class="fa fa-facebook"></span> Créer son compte avec Facebook
              </a>
          </div>
          <div class="form-group col-xs-12">
              <a class="btn btn-block btn-social btn-google">
                  <span class="fa fa-google-plus"></span> Créer son compte avec Google
              </a>
          </div>
      </form>
  </main>
@endsection
