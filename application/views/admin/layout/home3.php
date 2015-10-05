<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<base href="<?php echo base_url(); ?>" />
	<title>Hệ thống quản lý CSM</title>
	<link href="template/css/bootstrap.min.css" rel="stylesheet"></link>
	<script src="template/js/jquery-2.1.3.min.js"></script>
	<script src="template/js/bootstrap.min.js"></script>
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" rel="home" href="#">Trang chủ</a>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li><a href="backend/members/index">Hội viên</a></li>
				<li><a href="#">Nhật ký giao dịch</a></li>
				<li><a href="#">Nhật ký web</a></li>
				<li><a href="#">Nhật ký máy chủ</a></li>
				<li><a href="#">Quản lý máy trạm</a></li>
				<li><a href="backend/account/info">Đổi mật khẩu</a></li>
				<li><a href="backend/auth/logout" title="Đăng xuất">Đăng xuất</a></li>
			</ul>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="page-header"><p>Chào <strong><?php //echo $data['auth']['username']; ?></strong></p></div>
	<?php $this->load->view($template, isset($data) ? $data: NULL); ?>
</div>
</body>
</html>