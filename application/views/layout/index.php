<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="public/img/favicon.ico">

	<title><?php echo CW_TITLE; ?></title>
	<base href="<?php echo base_url(); ?>" />

	<!-- Bootstrap core CSS -->
	<link href="template/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="template/css/offcanvas.css" rel="stylesheet">

	<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
	<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
	<script src="template/js/ie-emulation-modes-warning.js"></script>

	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<script src="template/js/ie10-viewport-bug-workaround.js"></script>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="template/js/jquery.min.js"></script>
	<script src="template/js/bootstrap.min.js"></script>
	<script src="template/js/offcanvas.js"></script>
</head>
<body>
	<div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">CSMWEB</a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="">Home</a></li>
					<li><a href="#about">Liên hệ</a></li>
					<li><a href="#contact">Góp ý</a></li>
				</ul>
			</div><!-- /.nav-collapse -->
		</div><!-- /.container -->
	</div><!-- /.navbar -->

	<div class="container">
		<div class="row">
			<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
				<?php $this->load->view($template, isset($data) ? $data: NULL); ?>
			</div>
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
				<div class="row">
					<div class="col-md-12">
						<?php echo $user_box; ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<?php echo $list_service; ?>
					</div>
				</div>
			</div>
		</div>
		<hr />
		<footer>
			<p>&copy; Company 2015</p>
		</footer>
	</div><!--/.container-->
</body>
</html>