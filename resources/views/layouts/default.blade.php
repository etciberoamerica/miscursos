<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    {!! Html::style('static/assets/css/bootstrap.css') !!}
    {!! Html::style('static/assets/css/style.main.css') !!}
    {!! Html::script('static/assets/js/jquery-1.11.3.js') !!}
    {!! Html::script('static/assets/js/bootstrap.js') !!}
    {!! Html::script('static/assets/js/particles.js') !!}
    @yield('scripts')


</head>
<body>
@yield('content')
<div id="particles"></div>
</body>
</html>