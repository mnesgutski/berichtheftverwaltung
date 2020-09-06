<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Report</title>
</head>
<body>

<h1>Ausbildungsbericht von {{$user->username}}</h1>
<table style="border-color: #1b1e21; border-width: 2px;">
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
                @foreach($entries as $entry)
                    <p style="text-decoration: underline;">{{$entry['header']}}</p>
                    <p>{{$entry['description']}}</p>
                @endforeach
            </td>
            <td>
                @foreach($entries as $entry)
                    {{$entry['duration']}}
                @endforeach
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>