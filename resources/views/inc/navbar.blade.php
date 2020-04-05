<nav class="w-100 navbar navbar-expand-md bg-dark navbar-dark">
  <div class="container">
    <a class="navbar-brand" href="">
        {{ config('app.name', 'Laravel') }}
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Left Side Of Navbar -->
      
      <ul class="navbar-nav mr-auto">
        @auth
          <li class="nav-item"><a class="nav-link" href="{{ route('pages.timeMachine') }}">Time Machine</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('pages.tictactoe') }}">TicTacToe</a></li>
          <li class="nav-item">
          <!-- This will be a list where you can save the items you want to buy in grocery stores. Also think about making it cross user available. -->
          <a class="nav-link" href="{{ route('pages.grocery') }}">Grocery-list</a></li> 
          <li class="nav-item"><a class="nav-link" href="{{ route('pages.export') }}">Export</a></li>
           
          {{-- <li class="nav-item"><a class="nav-link" href="#">Change Employer</a></li> --}}
          
        @endauth
      </ul>

      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ml-auto">
          <!-- Authentication Links -->
          @guest
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
              @if (Route::has('register'))
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                  </li>
              @endif
          @else
              <li class="nav-item dropdown">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                      {{ Auth::user()->name }} <span class="caret"></span>
                  </a>

                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                          {{ __('Logout') }}
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                      <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                  </div>
              </li>
          @endguest
      </ul>
    </div>
  </div>
</nav>