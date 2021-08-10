<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Checklist | 403 Forbidden</title>

	<!-- Fonts -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;display=swap">

	<!-- Stylesheet -->
	<link rel="stylesheet" href="{{asset('assets/css/icons/fontawesome/styles.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/mdb.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/mdb.lite.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

	<script type="text/javascript" src="{{asset('assets/js/jquery.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/js/popper.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/js/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/js/mdb.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/js/custom.js')}}"></script>

</head>

<body>
	<div class="page-container">
		<div class="container">
			<div class="text-center error-content-group">
				<h1 class="error-title"><i class="fa fa-ban mr-2" aria-hidden="true"></i>405</h1>
                <h5>Laravel Error. Contact System Administrator when you encounter this page.</h5>
				<h5>Please click the button below to go back to MyHUB.</h5>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="text-center">
						<a href="{{ url(config('app.myhub_url')) }}" class="btn btn-error-redirect waves-effect waves-light">
							<i class="fa fa-arrow-left mr-2" aria-hidden="true"></i>Back to MyHUB</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>