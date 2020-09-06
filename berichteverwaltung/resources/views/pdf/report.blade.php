<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Report</title>
</head>

<style>
    td{
        border: 1px solid black;
    }
</style>

<body>

<h1>Ausbildungsbericht von {{$user->username}}</h1>
<table>
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
                <table>
                    @foreach($entries as $entry)
                        <tr>
                            <td>
                                <p style="text-decoration: underline;">{{$entry['header']}}</p>
                                <p>{{$entry['description']}}</p>

                            </td>
                        </tr>
                    @endforeach
                </table>
            </td>
            <td>
                <table>
                    @foreach($entries as $entry)
                        <tr>
                            <td style="float: right;">
                                {{$entry['duration']}}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>