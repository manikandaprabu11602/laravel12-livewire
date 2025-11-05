<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Superadmin</title>

    <!-- CoreUI -->
    <link href="{{ asset('coreui/css/style.css') }}" rel="stylesheet">

    @livewireStyles
    @stack('head')
  </head>
  <body>
    @include('partials.superadmin.sidebar')
    <div class="wrapper d-flex flex-column min-vh-100">
      @include('partials.superadmin.header')

      <main class="body flex-grow-1 px-3">
        @yield('content')
      </main>

      @include('partials.superadmin.footer')
    </div>

    <script src="{{ asset('coreui/js/main.js') }}"></script>
    @livewireScripts
    @stack('scripts')
  </body>
</html>
