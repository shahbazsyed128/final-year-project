<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel 8 User Roles and Permissions Tutorial') }}</title>
    <!-- Scripts -->
   
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body style="background:#e9ecef;">
    <div id="app">
        <main>
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/app.js') }}" ></script>
@if(Session::has('message'))
  <script>
     Toast.fire({
        icon: 'success',
        title: "{{ Session::get('message') }}"
      });
      
  </script>  
@endif

@if(Session::has('warning'))
  <script>
     Toast.fire({
        icon: 'warning',
        title: "{{ Session::get('warning') }}"
      });
      
  </script>  
@endif
</body>
</html>