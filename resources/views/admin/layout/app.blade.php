<html>
    <head>
        <title>CRUD APP</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap.min.css') }}">
        @stack('styles')
    </head>
    <body>

        <div class="container mt-5">
            <div class="row">
                <div class="col-sm-12">
                    @yield('content')
                </div>
            </div>
        </div>
    
        <!-- jQuery library -->
        <script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>
        <!-- Latest compiled JavaScript -->
        <script src="{{ asset('assets/admin/js/bootstrap.min.js') }}"></script>
        @stack('scripts')
    </body>
</html>