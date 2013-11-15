<!DOCTYPE html>
<html lang=”en”>
    <head>
        <meta charset="UTF-8" />
        <link
            type="text/css"
            rel="stylesheet"
            href="{{ asset('css/bootstrap.min.css') }}" />
        <script type="text/javascript" src="{{ asset('js/jquery-1.10.2.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
        <title>
            Learning Centre Application
        </title>
    </head>
    <body>
        <div class="container">
            @include("header")
            <div class="content">
                
                    @yield("content")
                
            </div>
        </div>
        @include("footer")
    </body>
</html>