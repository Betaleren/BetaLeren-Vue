<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Betaleren</title>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="Joey Roeters, Pascal Huberts, Hessel Doesburg">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:200&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <link rel="icon" type="image/png" href="img/website/beta.png">
        <link rel="stylesheet" href="css/app.css">
        <script>window.Laravel = { crsfToken: '{{ csrf_token()  }}' }</script>
    </head>
    <body>
        <div id="app">
            <main></main>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
