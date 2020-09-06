<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Report</title>
</head>

<style>
    * {
        font-family: Arial;
    }

    .table-border {
        border: 1px solid black;
    }

    .border-bottom {
        border-bottom: 1px solid black;
    }
    .border-left{
        border-left: 1px solid black;
    }

    .eightyeight {
        width: 88%;
    }

    .twelve {
        width: 12%;
    }

    .center {
        text-align: center;
    }

    .small{
        font-size: 10px;
        font-style: italic;
        margin-top: -7px;
        margin-left: 35px;
    }
</style>

<body>

<h1>Ausbildungsbericht Nr. {{$pos}} von {{$user->username}} </h1>
<p>vom {{$from}} bis {{$to}}</p>
<table class="table-border">
    <thead>
    <tr>
        <td class="center border-bottom"><b>Typ</b></td>
        <td class="center border-bottom"><b>Inhalt</b></td>
    </tr>
    </thead>
    <tbody>
    @foreach($report as $type => $entries)
        <tr>
            <td class="center border-bottom">
                <b>{{$type}}</b>
            </td>
            <td class="border-bottom">
                <table style="width: 100%">
                    <thead>
                    <tr>
                        <td class="eightyeight center border-bottom border-left">Tätigkeit</td>
                        <td class="twelve center border-bottom">Zeit</td>
                    </tr>
                    </thead>
                    @foreach($entries as $entry)
                        <tr>
                            <td class="eightyeight border-left">
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
<br>
<br>

<table style="width:100%">
    <thead>
    <tr>
        <td style="width: 45%; margin-right: 5%;" class="center">Auszubildende/r</td>
        <td style="width: 45%; margin-right: -5%; float: right;" class="center">Ausbildende/r</td>
    </tr>
    </thead>
    <tr>
        <td style="width: 50%; ">
            <br>
            <br>
            <br>
            <br>
            <hr class="center" style="width: 80%;">
            <p class="small">Datum, Unterschrift</p>
        </td>
        <td style="width: 50%;" >
            <br>
            <br>
            <br>
            <br>
            <hr class="center" style="width: 80%;">
            <p class="small">Datum, Unterschrift</p>
        </td>
    </tr>
</table>
</body>
</html>