<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Homegear RPC Server</title>
	<!-- Bootstrap core CSS -->
	<link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="../assets/css/main.css" rel="stylesheet" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/script.inc.js"></script>
</head>
<body>
<div class="jumbotron">
	<div class="container">
		<small class="pull-right">
			<b>Version:</b> <?= $hgVersion ?>
		</small>
		<img style="float: left; margin-top: 13px; margin-right: 40px" src="assets/images/Logo.png" />
		<h2>admin Interface</h2>
		<h1>Loxone - Homegear</h1>
		<h2>module</h2>
	</div>
</div>
<div class="container marketing">
	<div class="row">
		<div style="height: 150px" class="col-lg-3">
			<!-- span class="icon-nodes" style="font-size: 140px"></span -->
			<h2>Device Overview</h2>
			<input id="deviceOverview" type="button" value="show Device Overview" />
		</div><!-- /.col-lg-3 -->
		<div style="height: 150px" class="col-lg-3">
			<!-- span class="icon-nodes" style="font-size: 140px"></span -->
			<h2>Help</h2>
		</div><!-- /.col-lg-3 -->
		<div style="height: 150px" class="col-lg-3">
			<!-- span class="icon-nodes" style="font-size: 140px"></span -->
			<h2>Debugging</h2>
			<input id="log" type="button" value="show Miniserver Log" />
		</div><!-- /.col-lg-3 -->
	</div><!-- /.row -->
	<div class="row">
		<div id="dynamic">
			<div class="dynamicContent" />
		</div>
	</div>	
	<footer>
		<p class="pull-right">
			<a href="#">Back to top</a>
		</p>
		<p>
			&copy; 2017-<?= date('Y') ?> TR
		</p>
	</footer>
</div>
</body>
</html>