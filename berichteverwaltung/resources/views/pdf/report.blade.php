<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Report</title>
</head>

<style>
    *{
        font-family: Arial;
    }
    .table-border{
        border: 1px solid black;
    }
    .eightyeight{
        width: 88%;
    }
    .twelve{
        width: 12%;
    }
    .center{
        text-align: center;
    }
</style>

<body>

<h1>Ausbildungsbericht Nr. {{$pos}} von {{$user->username}} </h1>
<p>vom {{$from}} bis {{$to}}</p>
<table class="table-border">
    <thead>
    <tr>
        <td><b>Typ</b></td>
        <td><b>Inhalt</b></td>
    </tr>
    </thead>
    <tbody>
    @foreach($report as $type => $entries)
        <tr>
            <td class="center">
                <b>{{$type}}</b>
            </td>
            <td>
                <table style="width: 100%">
                    <thead>
                    <tr>
                        <td class="eightyeight center" >Tätigkeit</td>
                        <td class="twelve center" >Zeit</td>
                    </tr>
                    </thead>
                    @foreach($entries as $entry)
                        <tr>
                            <td class="eightyeight">
                                <p style="text-decoration: underline;">{{$entry['header']}}</p>
                                <p>{{$entry['description']}}</p>
                            </td>
                            <td class="twelve center">
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









{{--<table>--}}
{{--    <thead>--}}
{{--    <tr>--}}
{{--        <td><b>Typ</b></td>--}}
{{--        <td><b>Inhalt</b></td>--}}
{{--        <td><b>Zeit</b></td>--}}
{{--    </tr>--}}
{{--    </thead>--}}
{{--    <tbody>--}}
{{--    @foreach($report as $type => $entries)--}}
{{--        <tr>--}}
{{--            <td>--}}
{{--                <b>{{$type}}</b>--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                <table>--}}
{{--                    @foreach($entries as $entry)--}}
{{--                        <tr>--}}
{{--                            <td>--}}
{{--                                <p style="text-decoration: underline;">{{$entry['header']}}</p>--}}
{{--                                <p>{{$entry['description']}}</p>--}}

{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
{{--                </table>--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                <table>--}}
{{--                    @foreach($entries as $entry)--}}
{{--                        <tr>--}}
{{--                            <td style="float: right;">--}}
{{--                                {{$entry['duration']}}--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
{{--                </table>--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--    @endforeach--}}
{{--    </tbody>--}}
{{--</table>--}}
</body>
</html>