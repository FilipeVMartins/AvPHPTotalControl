<!DOCTYPE html>


<html>
    <head>
        <meta charset="utf-8">
        <title>AvPHPTotalControl</title>
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
        @include('includes.navbar')
        @include('includes.avisos')
        <div class="container col-md-12 col-lg-12">
            @yield("content")
        </div>
    </body>


</html>