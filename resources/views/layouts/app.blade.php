<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{config('app.name', 'Time-Machine-New')}}</title>
  
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/airbnb.css')}}">
    @yield('tictactoeCSS')

    {{-- <link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert.css')}}"> --}}

    <!-- Scripts -->
    <script defer src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"></script>
    <script async src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>  
    <script async src="{{ asset('js/app.js') }}"></script>
    {{-- <script defer src="{{asset('js/main.js')}}" type="text/javascript" charset="utf-8"></script> --}}
    @yield('pagespecificscripts')
    @yield('tictactoeJS')
    
        
    <!-- Fonts -->

    
</head>

<body>
  <div id="app" class="h-100">
    <div id="lightbox" class="h-100">  
      <div class="d-flex p-1 justify-content-between mb-2">
        @guest
          <span>Welcome, please login!</span> 
        @else
          <span>Welcome {{ Auth::user()->name }}</span>
        @endguest
        <span id="date-element"></span>
      </div>

      @include('inc.navbar')

      <div class="container my-2">
        @include('inc.messages') 
        @yield('content')
      </div>
        
      <div id="picturebox" class="h-100">
      </div>
    </div>
  </div>
  
  
  <!-- More Scripts, move em up to the head -->
  {{-- <script src="{{asset('js/app.js')}}" type="text/javascript" charset="utf-8" async defer></script>
    <script src="{{asset('js/jquery.js')}}" type="text/javascript" charset="utf-8" async defer></script> --}}
  {{-- <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script> --}}
    {{-- <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script> --}}
    {{-- <script src="{{asset('js/sweetalert.min.js')}}" type="text/javascript" charset="utf-8" async defer></script> --}}

</body>
</html>
