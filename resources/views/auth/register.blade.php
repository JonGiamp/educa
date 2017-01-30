@extends('layouts.master')

@section('title', 'Educa - Inscription' )

  @section('content')
  <style>
  .form-horizontal .control-label {
    text-align: left !important;
  }
  </style>
  <div class="container">
    <div class="col-lg-5">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('accueil') }}">Accueil</a></li>
        <li class="breadcrumb-item active">Inscription</li>
      </ol>
    </div>
  </div>

  <main id="account" class="container">
    <div class="col-xs-12">
      <h2>Il est l'heure de se lancer !</h2>
    </div>
    <form class="col-sm-6 col-xs-12 form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
      {{ csrf_field() }}
      <h3>Créer un compte</h3>

      <div class="col-xs-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-xs-12 control-label">Votre pseudo</label>

        <div class="col-xs-12">
          <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

          @if ($errors->has('name'))
            <span class="help-block">
              <strong>{{ $errors->first('name') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <div class="col-xs-12 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="col-xs-12 control-label">Votre adresse email</label>

        <div class="col-xs-12">
          <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

          @if ($errors->has('email'))
            <span class="help-block">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <div class="col-xs-12 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password" class="col-xs-12 control-label">Votre mot de passe</label>

        <div class="col-xs-12">
          <input id="password" type="password" class="form-control" name="password" required>

          @if ($errors->has('password'))
            <span class="help-block">
              <strong>{{ $errors->first('password') }}</strong>
            </span>
          @endif
        </div>
      </div>

      <div class="col-xs-12 form-group">
        <label for="password-confirm" class="col-xs-12 control-label">Confirmez votre mot de passe</label>

        <div class="col-xs-12">
          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        </div>
      </div>

      <div class="col-xs-12 form-group">
        <div>
          <button type="submit" class="btn btn-default btn-action">
            Créer votre compte
          </button>
        </div>
      </div>

      <div class="col-xs-12 form-group">
        <div class="col-xs-12">
          <div class="form-group col-xs-12">
            <a class="btn btn-block btn-social btn-facebook">
              <span class="fa fa-facebook"></span> Créer votre compte avec Facebook
            </a>
          </div>
        </div>
      </div>

    </form>
  </main>
</div>
</div>
</div>
</div>
</div>
@endsection
