<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>未来的超级巨星</title>

    <!-- Styles -->
</head>
<body>
    <div class="container">
        <form action="{{ route('make.super.star') }}" method="post">

            {{ csrf_field() }}

            <input type="text" name="username">

            <input type="radio" name="type" value="nba"> NBA
            <input type="radio" name="type" value="cba"> CBA

            <button type="submit">submit</button>
        </form>
    </div>
</body>
</html>
