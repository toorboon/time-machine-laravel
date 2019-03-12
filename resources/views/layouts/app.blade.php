<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
		  <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
      {{-- <link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert.css')}}"> --}}
      <title>{{config('app.name', 'Time-Machine-New')}}</title>

    </head>
    <body>
      <div id="lightbox" class="h-100"> 	
        <div class="d-flex p-1 justify-content-between mb-2">
      		<span>Welcome Username</span>
     		  <span id="date-element">date</span>
    	  </div>

  	
       	@yield('content')

    	  @include('inc.navbar')
  		
    		<div id="picturebox" class="h-100">picture
      	</div>
      </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"></script> 
    {{-- <script src="{{asset('js/app.js')}}" type="text/javascript" charset="utf-8" async defer></script>
    <script src="{{asset('js/jquery.js')}}" type="text/javascript" charset="utf-8" async defer></script> --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>  
    {{-- <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script> --}}
    {{-- <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script> --}}
    {{-- <script src="{{asset('js/sweetalert.min.js')}}" type="text/javascript" charset="utf-8" async defer></script> --}}
    @yield('pagespecificscripts')

    </body>
</html>
