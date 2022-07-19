<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <!-- Tell the browser to be responsive to screen width -->
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <title>Election Monitor</title>
	    <meta name="csrf-token" content="{{ csrf_token() }}" />
    	<link rel="shortcut icon" href="/images/favicon.png">
		<link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet">

	    <!-- <link href="/css/style.css" rel="stylesheet"> -->
	    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
		    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body class="fix-header fix-sidebar card-no-border"  style="overflow: hidden">
	    <div id="root">
	        <router-view></router-view>
	    </div>
	    <script src="{{ config('services.app.app_url') }}/js/bundle.min.js"></script>
	</body>
</html>
