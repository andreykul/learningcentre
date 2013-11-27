<!DOCTYPE html>
<html lang=”en”>
    <head>
        <meta charset="UTF-8" />
        <link
            type="text/css"
            rel="stylesheet"
            href="{{ asset('css/bootstrap.min.css') }}" />
        <link
            type="text/css"
            rel="stylesheet"
            href="{{ asset('css/jquery-ui-1.10.3.custom.min.css') }}" />
        <link
            type="text/css" 
            rel="stylesheet"
            href="{{ asset('css/bootstrap-select.min.css') }}" />
        <link
            type="text/css" 
            rel="stylesheet"
            href="{{ asset('css/bootstrap-input-file.min.css') }}" />
        <script type="text/javascript" src="{{ asset('js/jquery-1.10.2.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery-ui-1.10.3.custom.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/underscore-min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/bootstrap-select.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/bootstrap-input-file.min.js') }}"></script>
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