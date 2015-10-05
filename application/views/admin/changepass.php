<section class="content-header">
	<h1>Đổi mật khẩu ADMIN</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#">Examples</a></li>
		<li class="active">Blank page</li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header"></div><!-- /.box-header -->
				<div class="box-body">
					<form action="admin/changepass/change" method="post" class="form-horizontal">
						<div class="form-group">
							<label class="control-label col-xs-4 col-sm-4 col-md-4 col-lg-4">Tài khoản</label>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
								<p class="form-control-static"><?php echo $recs; ?></p>
								<input type="hidden" name="username" value="<?php echo $recs; ?>">
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 ">
								<?php echo form_error('username', '<span class="label label-danger"><i>', '</i></span>'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-4 col-sm-4 col-md-4 col-lg-4" for="oldpw">Mật khẩu củ</label>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 <?php if(form_error('oldpw')) echo "has-error has-feedback"; ?>">
								<input type="password" name="oldpw" class="form-control input-sm" autocomple="off" />
								<?php if(form_error('oldpw')): ?>
								<span class="glyphicon glyphicon-remove form-control-feedback"></span>
								<?php endif; ?>
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 ">
								<?php echo form_error('oldpw', '<span class="label label-danger"><i>', '</i></span>'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-4 col-sm-4 col-md-4 col-lg-4" for="newpw">Mật khẩu mới</label>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 <?php if(form_error('newpw')) echo "has-error has-feedback"; ?>">
								<input type="password" name="newpw" class="form-control input-sm" autocomple="off" />
								<?php if(form_error('newpw')): ?>
								<span class="glyphicon glyphicon-remove form-control-feedback"></span>
								<?php endif; ?>
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 ">
								<?php echo form_error('newpw', '<span class="label label-danger"><i>', '</i></span>'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-4 col-sm-4 col-md-4 col-lg-4" for="confignewpw">Xác nhận mật khẩu mới</label>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 <?php if(form_error('confignewpw')) echo "has-error has-feedback"; ?>">
								<input type="password" name="confignewpw" class="form-control input-sm" autocomple="off" />
								<?php if(form_error('confignewpw')): ?>
								<span class="glyphicon glyphicon-remove form-control-feedback"></span>
								<?php endif; ?>
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 ">
								<?php echo form_error('confignewpw', '<span class="label label-danger"><i>', '</i></span>'); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
								<input type="submit" name="change" value="Thay đổi" class="btn btn-primary" />
								<input type="reset" name="cancel" value="Hủy bỏ" class="btn btn-primary" />
							</div>
						</div>
					</form>
				</div>
		<!-- Default box -->
		</div>
	</div>
</section>
