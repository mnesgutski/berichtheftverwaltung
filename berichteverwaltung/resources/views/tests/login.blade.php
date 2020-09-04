<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

</head>
<body>
<form action="login/microsoft" method="get">
    @CSRF
    <input type="text" name="email" id="email"><br>
    <input type="password" name="password" id="password"><br>
    <button type="submit">Submit</button>
</form>

</body>
</html>
