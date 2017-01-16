<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="{{ route('accueil') }}">Accueil</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Les niveaux <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('niveaux', ['level' => 'cp']) }}"><img src="{{ URL::asset('images/ico-dog.svg') }}" alt="Icone CP"> CP</a></li>
                        <li><a href="{{ route('niveaux', ['level' => 'ce1']) }}"><img src="{{ URL::asset('images/ico-cat.svg') }}" alt="Icone CE1"> CE1</a></li>
                        <li><a href="{{ route('niveaux', ['level' => 'ce2']) }}"><img src="{{ URL::asset('images/ico-rabbit.svg') }}" alt="Icone CE2"> CE2</a></li>
                        <li><a href="{{ route('niveaux', ['level' => 'cm1']) }}"><img src="{{ URL::asset('images/ico-monkey.svg') }}" alt="Icone CM1"> CM1</a></li>
                        <li><a href="{{ route('niveaux', ['level' => 'cm2']) }}"><img src="{{ URL::asset('images/ico-lion.svg') }}" alt="Icone CM2"> CM2</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Les jeux <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('jeux', ['matieres' => 'francais']) }}"><img src="{{ URL::asset('images/ico-francais.svg') }}" alt="Icone Français"> Français</a></li>
                        <li><a href="{{ route('jeux', ['matieres' => 'sciences']) }}"><img src="{{ URL::asset('images/ico-sciences.svg') }}" alt="Icone Sciences"> Sciences</a></li>
                        <li><a href="{{ route('jeux', ['matieres' => 'mathematiques']) }}"><img src="{{ URL::asset('images/ico-mathematique.svg') }}" alt="Icone Mathématiques"> Mathématiques</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('scores') }}">Mes scores</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
            </ul>

            @if (Auth::check())
              <ul class="nav navbar-nav navbar-right">
                  <li><a href="{{ route('logout') }}">Déconnexion</a></li>
              </ul>
            @else
              <ul class="nav navbar-nav navbar-right">
                  <li><a href="{{ route('connexion') }}">Connexion / Inscription</a></li>
              </ul>
            @endif

        </div><!--/.nav-collapse -->
    </div>
</nav>
