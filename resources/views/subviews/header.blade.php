<header>
  <div class="container">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <a href="{{ route('accueil') }}"><img src="{{ URL::asset('images/logo.png') }}" alt="Logo Educa" class="img-responsive logo"></a>
      </div>
      @if (Auth::check())
        <?php
          $experience = Auth::user()->experience;
          $level = Auth::user()->level ;
          $exp_percent = 100 - ($level * 100 - $experience);
        ?>
        <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs">
            <div class="panel-player">
                <div class="level">
                    <p>{{ $level }}</p>
                </div>
                <div class="name">
                    <a href="{{ route('options') }}">{{ Auth::user()->name }}</a>
                </div>
                <div class="avatar">
                  <img src="{{ URL::asset('images/avatar/avatar_'.Auth::user()->avatar.'.svg') }}" alt='Mon avatar' class="avatar" />
                </div>
                <div class="progress-bar">
                    <div style="width: {{ $exp_percent }}%"></div>
                </div>
            </div>
        </div>
      @endif
  </div>
</header>
