<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Đăng nhập</h3>
	</div>
	<form method="post" action="<?php echo base_url(); ?>auth/login">
		<div class="panel-body">
			<?php echo $errors; ?>
			<div class="input-group" style="margin-bottom:10px;">
				<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
				<input type="text" name="data[username]" class="form-control" placeholder="Tài khoản" autocomplete="off" required autofocus />
			</div>
			<div class="input-group" style="margin-bottom:10px;">
				<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
				<input type="password" name="data[password]" class="form-control" placeholder="Mật khẩu" autocomplete="off" required />
			</div>
		</div>
		<div class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-center">
					<input type="submit" name="login" value="Đăng nhập" class="btn btn-default" />
				</div>
			</div>
		</div>
	</form>
</div>