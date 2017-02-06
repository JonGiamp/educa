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
              <i class='hi-icon fa fa-twitter'><a href="https://twitter.com/educa_team"></a></i>
              <i class='hi-icon fa fa-facebook'><a href="https://www.facebook.com/teameduca"></a></i>
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
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-91403574-1', 'auto');
    ga('send', 'pageview');
  </script>
  <script type="text/javascript">
          tarteaucitron.user.analyticsUa = 'UA-91403574-1';
          tarteaucitron.user.analyticsMore = function () { /* add here your optionnal ga.push() */ };
          (tarteaucitron.job = tarteaucitron.job || []).push('analytics');
  </script>
</footer>
