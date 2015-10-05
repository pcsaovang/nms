<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Đăng nhập</h3>
				</div>
				<form method="post" action="" style="margin-bottom: 0px;">
				<div class="panel-body">
					<?php echo validation_errors(); ?>
					<div class="input-group" style="margin-bottom:10px;">
						<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
						<input type="text" name="data[username]" class="form-control" placeholder="Tài khoản" autocomplete="off" required autofocus />
					</div>
					<div class="input-group" style="margin-bottom:10px;">
						<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
						<input type="password" name="data[password]" class="form-control" placeholder="Mật khẩu" autocomplete="off" required />
					</div>
					<div class="form-group">
					<i><h6>Sử dụng tài khoản quản trị lúc cài CSM để đăng nhập.<br /><br />Ngoài ra không thể đăng nhập bằng bất kỳ tài khoản nào khác.</h6></i>
					</div>
				</div>
				<div class="panel-footer">
					<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
					<input type="submit" name="login" value="Đăng nhập" class="btn btn-default" />
					<input type="reset" value="Làm lại" class="btn btn-default" />
					</div>
					<div class="col-md-2"></div>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>