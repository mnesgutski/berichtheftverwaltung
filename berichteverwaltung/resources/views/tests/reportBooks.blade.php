<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

</head>
<body>
	login war erfolgreich

	@if(Auth::check())
		hallo
		{{auth()->user()->username}}
		@if(null !== $reportBooks = auth()->user()->reportBooks)
			@foreach($reportBooks as $reportBook)
				<div class="col-3">report book ID: {{$reportBook->id}}</div>
			@endforeach
		@endif

		<div class="col-2">
			<form action="{{route('test.create.reportBook')}}" method="post">
				@CSRF
				<button type="submit">
					create reportBook
				</button>
			</form>
		</div>

	@endif



</body>
</html>
