<footer>
  <div class="container">
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <h4>Plan du site</h4>
          <ul>
              <li><a href="{{ route('accueil') }}">Accueil</a></li>
              <li><a href="{{ route('scores') }}">Mes scores</a></li>
              <li><a href="{{ route('scores') }}">Mes récompenses</a></li>
              @if (Auth::check())
                <li><a href="{{ route('options') }}">Mon profil</a></li>
              @endif
              <li><a href="{{ route('contact') }}">Contact</a></li>
              <li><a href="{{ route('mentions') }}">Mentions légales</a></li>
          </ul>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <h4>A propos de nous</h4>
          <p>
            Apprenti développeur, nous sommes un groupe d'étudiant de l'IUT Haguenau qui se donne à fond pour faire vivre ce projet open-source. N'hésitez pas à nous suivre sur Github afin de contribuer au projet !
          </p>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <h4>Nous suivre sur :</h4>
          <div class="hi-icon-wrap hi-icon-effect-1 hi-icon-effect-1a">
              <i class='hi-icon fa fa-twitter'><a href="http://twitter.com"></a></i>
              <i class='hi-icon fa fa-facebook'><a href="http://facebook.com"></a></i>
          </div>
          <h4>Rejoindre le projet sur GitHub</h4>
          <div class="hi-icon-wrap hi-icon-effect-1 hi-icon-effect-1a">
              <i class='hi-icon fa fa-github'><a href="https://github.com/JonGiamp/Educa"></a></i>
          </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <p class="copy">IUT Haguenau {{date('Y')}} - Tout droits réservés</p>
      </div>
  </div>
</footer>
