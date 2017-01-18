@extends('layouts.master')

@section('title', 'Educa - Erreur 502')

@section('content')
  <div class="container">
      <div class="col-lg-5">
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('accueil') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Page introuvable</li>
          </ol>
      </div>
  </div>


  <main id="divers" class="container">
      <div class="col-xs-12">
          <img src="{{ URL::asset('images/icons/ico-dog.svg') }}" alt="page non trouvée" class="img-responsive" />
          <h1>Error 502 : Désolé mais cette page n'existe pas.</h1>
          <a href="{{ route('accueil') }}" class="btn">Retour à l'accueil</a>
      </div>
  </main>
@endsection
