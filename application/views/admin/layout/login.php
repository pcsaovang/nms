<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<base href="<?php echo CW_BASE_URL; ?>" />
		<title>Hệ thống quản lý CSM</title>
		<link href="template/css/bootstrap.min.css" rel="stylesheet"></link>
		<link href="template/css/style.css" rel="stylesheet">
		<script src="template/js/jquery-2.1.3.min.js"></script>
		<script src="template/js/bootstrap.min.js"></script>
	</head>
	<body>
	<?php $this->load->view($template, isset($data) ? $data : NULL); ?>
	</body>
</html>