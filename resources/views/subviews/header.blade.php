<header>
  <div class="container">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <a href="{{ route('accueil') }}"><img src="{{ URL::asset('images/logo.png') }}" alt="Logo Educa" class="img-responsive"></a>
      </div>
      @if (Auth::check())
        <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs">
            <div class="panel-player">
                <div class="level">
                    <p>{{ Auth::user()->level }}</p>
                </div>
                <div class="name">
                    <a href="{{ route('options') }}">{{ Auth::user()->name }}</a>
                </div>
                <div class="avatar">
                    <i class="fa fa-facebook"></i>
                </div>
                <div class="progress-bar">
                    <div></div>
                </div>
            </div>
        </div>
      @endif
  </div>
</header>
