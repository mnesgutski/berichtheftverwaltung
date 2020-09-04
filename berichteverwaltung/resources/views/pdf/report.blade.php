<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Report</title>
</head>
<body>

<h1>Ausbildungsbericht von {{$user->username}}</h1>
<table class="table table-bordered">
    <thead>
    <tr>
        <td><b>Typ</b></td>
        <td><b>Inhalt</b></td>
        <td><b>Zeit</b></td>
    </tr>
    </thead>
    <tbody>
        @foreach($report as $type => $entries)
    <tr>
        <td>
            <b>{{$type}}</b>
        </td>
        <td>
            
            <p style="text-decoration: underline;">{{$entry->header}}</p>
            <p>{{$entry->description}}</p>
        </td>
        <td>
            {{$entry}}
        </td>
        <hr>
    </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>