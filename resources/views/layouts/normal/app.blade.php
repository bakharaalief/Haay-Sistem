<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    @yield('css')
</head>
<body>
    <div id="app">
        @include('layouts.normal.navbar')

        <main>
            @yield('content')
        </main>

        @include('layouts.normal.footer')
    </div>

    {{-- logout modal --}}
    <div class="modal fade" id="form-logout">
        <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
            <h4 class="modal-title">Logout</h4>
            <button menu="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>

            <form method="POST" action="{{ route('logout') }}">
            @csrf
            
            <div class="modal-body">
                <p>Anda Yakin Ingin Logout ? </p>
            </div>
            <div class="modal-footer justify-content-between">
                <button menu="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button menu="submit" class="btn btn-danger">Iya</button>
            </div>

            </form>
        </div>
        </div>
    </div>
</body>

<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

{{-- logout model configurarion --}}
<script>
    $(function(){
      $('.button-logout').on("click", function(event) {
        $("#form-logout").modal('show');
      });
    })
</script>

{{-- js --}}
@yield('js')
</html>
