@extends('layouts.master')

@section('title', 'Educa - Connexion' )

  @section('content')

    <div class="container">
      <div class="col-lg-5">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('accueil') }}">Accueil</a></li>
          <li class="breadcrumb-item active">Connexion</li>
        </ol>
      </div>
    </div>


    <main id="account" class="container">
      <div class="col-xs-12">
        <h2>Content de vous revoir !</h2>
      </div>

      <form class="col-sm-6 col-xs-12" role="form" method="POST" action="{{ url('/login') }}">
        {{ csrf_field() }}
        <h3>Se connecter</h3>

        <div class="col-xs-12 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <label for="email" class="col-xs-12 control-label">Votre adresse email</label>

          <div class="col-xs-12">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

            @if ($errors->has('email'))
              <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="col-xs-12 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          <label for="password" class="col-xs-12 control-label">Password</label>

          <div class="col-xs-12">
            <input id="password" type="password" class="form-control" name="password" required>

            @if ($errors->has('password'))
              <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group">
          <div class="col-xs-12">
            <label style="padding-left: 18px;">
              <input type="checkbox" name="remember"> Se souvenir de moi
            </label>
          </div>
        </div>

        <div class="form-group">
          <div class="col-xs-12">
            <button type="submit" class="btn btn-default btn-action">
              Se connecter
            </button>
          </div>
        </div>

        {{-- <div class="form-group">
          <div class="col-xs-12">
            <div class="checkbox">
              <a class="btn btn-link" href="{{ url('/password/reset') }}">
                Vous avez oublié votre mot de passe ?
              </a>
            </div>
          </div>
        </div> --}}

        <div class="form-group">
          <div class="col-xs-12">
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
          </div>
        </div>

      </form>
    </main>
  </div>
</div>
</div>
</div>
@endsection
