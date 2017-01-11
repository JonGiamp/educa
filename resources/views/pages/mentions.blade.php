@extends('layouts.master')

@section('title', 'Educa - Mentions Légales')

@section('content')
  <div class="container">
      <div class="col-lg-5">
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('accueil') }}">Accueil</a></li>
              <li class="breadcrumb-item active">Mentions légales</li>
          </ol>
      </div>
  </div>


  <main id="divers" class="container">
      <div class="col-xs-12">
          <h2>Mentions Légales</h2>
          <h3>Conception et réalisation</h3>
          <p>Ses conception, design et réalisation ont été assurés par le groupe de projet apprenti Educa, composé de 3 étudiants de l'IUT de Haguenau situé 30 Rue du Maire André Traband, 67500 Haguenau, courriel : contacteduca@gmail.com. Les trois étudiants sont : Thomas KIRSCH, Johnathan GIAMPORCARO et Ludovic RODRIGUE.</p>

          <h3>Hébergement</h3>
          <p>Le site est hébérgé sur les serveurs de l'IUT de Haguenau.</p>

          <h3>Identification</h3>
          <p>Le site https://tp.iha.unistra.fr/projets/dweb01/educa/public/ que vous consultez actuellement est la propriété de : IUT de Haguenau, 30 Rue du Maire André Traband, 67500 Haguenau, France.</p>
          <p>Le directeur de la publication est Thomas KIRSCH.</p>

          <h3>Propriété intellectuelle</h3>
          <p>L'accès au site https://tp.iha.unistra.fr/projets/dweb01/educa/public/ vous en confère un droit d'usage privé et non exclusif.</p>
          <p>Tous les articles, photographies et autres documents publiés sur ce site sont la propriété de EDUCA ou utilisés avec l'autorisation de leur propriétaire ; ils sont soumis aux droits d'auteur et autres droits de propriété intellectuelle.</p>
          <p>L'utilisation frauduleuse de tout ou partie du site https://tp.iha.unistra.fr/projets/dweb01/educa/public/ est rigoureusement interdite. Nous userons de ces droits de propriété intellectuelle pour engager des poursuites, y compris pénales, en cas de violation de ces droits.</p>

          <h3>Données personnelles</h3>
          <p>Conformément à la loi Informatique et Libertés du 6 janvier 1978, vous disposez d'un droit d'accès, de rectification, de modification et de suppression des données personnelles que vous nous auriez communiquées. Vous pouvez exercer ce droit en envoyant un courrier à : IUT de Haguenau, 30 Rue du Maire André Traband, 67500 Haguenau, France</p>

          <h3>Contact</h3>
          <p>Vous pouvez nous contacter par courrier électronique à l'adresse contacteduca@gmail.com</p>
      </div>
  </main>
@endsection
