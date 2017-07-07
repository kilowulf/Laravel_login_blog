<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <title>{{config('app.name', 'CodeIQ')}}</title>

        <!-- Fonts -->
        

        <!-- Styles -->
        
    </head>
    <body>
        @include('inc.navbar')<!--Blade syntax/ points to file-->
        <br>
        <div class="container">
            @include('inc.messages')<!--generates flash messages for form validation-->
            @yield('content')
        </div>
            <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
            <script>
                CKEDITOR.replace( 'article-ckeditor' );
            </script>
    </body>
</html>