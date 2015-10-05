<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>HỘI VIÊN<small>Chi tiết hội viên</small></h1>
	<ol class="breadcrumb">
		<li><a href="admin"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="admin/members">Hội viên</a></li>
		<li class="active">Chi tiết</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<?php
		$dataform = array('class' => 'form-horizontal', 'id' => 'popup-validation');
		echo form_open("admin/members/saveuser/$userid", $dataform);
	?>
	<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="box box-primary">
			<div class="box-header text-right">
				<?php if(!empty($self)) echo '<span class="text-green">'.$self.'</span>'; ?>
				<?php if(validation_errors()): ?>
				<span class="text-red"><?php echo validation_errors('<i>', '</i>'); ?></span>
				<?php endif; ?>
			</div>
			<div class="box-body">
			<div class="row">
				<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1"><!--Phần bên trái-->
					<div class="form-group">
						<label class="control-label col-sm-3 col-md-3 col-lg-3" for="userid">Mã tài khoản</label>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<input type="text" class="form-control input-sm" name="data[userid]" value="<?php echo $recs->UserId; ?>" disabled autocomplete="off" />
						</div>
						<label class="control-label col-sm-3 col-md-3 col-lg-3" for="firstname">Tên</label>
						<div class="col-sm-3 col-md-3 col-lg-3 <?php if(form_error('data[firstname]')) echo "has-error has-feedback"; ?>">
							<input type="text" class="form-control input-sm" name="data[firstname]" value="<?php echo $recs->FirstName; ?>" class="form-control" autocomplete="off" />
							<?php if(form_error('data[firstname]')): ?>
							<span class="glyphicon glyphicon-remove form-control-feedback"></span>
							<?php endif; ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3 col-md-3 col-lg-3" for="middlename">Tên đệm</label>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<input type="text" class="form-control input-sm" name="data[middlename]" value="<?php echo $recs->MiddleName; ?>" class="form-control" autocomplete="off" />
						</div>
						<label class="control-label col-sm-3 col-md-3 col-lg-3" for="lastname">Họ</label>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<input type="text" class="form-control input-sm" name="data[lastname]" value="<?php echo $recs->LastName; ?>" class="form-control" autocomplete="off" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3 col-md-3 col-lg-3" for="birthdate">Ngày sinh</label>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<input type="text" class="form-control input-sm" name="data[birthdate]" value="<?php echo $recs->Birthdate; ?>" class="form-control" autocomplete="off" />
						</div>
						<label class="control-label col-sm-3 col-md-3 col-lg-3" for="recorddate">Ngày lập</label>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<input type="text" class="form-control input-sm" name="data[recorddate]" value="<?php echo date_format(date_create($recs->RecordDate), 'd-m-Y'); ?>" class="form-control" disabled autocomplete="off" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3 col-md-3 col-lg-3" for="usertype">Nhóm</label>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<input type="text" class="form-control input-sm" name="data[usertype]" value="<?php echo $price->PriceType; ?>" class="form-control" disabled autocomplete="off" />
						</div>
						<label class="control-label col-sm-3 col-md-3 col-lg-3" for="active">Trạng thái</label>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<input type="checkbox" name="data[active]" value="<?php echo $recs->Active; ?>" <?php if($recs->Active == 1) echo "checked='checked'"; ?> />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3 col-md-3 col-lg-3" for="expirydate">Ngày hết hạn</label>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<input type="text" class="form-control input-sm" name="data[expirydate]" value="<?php echo $recs->ExpiryDate; ?>" class="form-control" autocomplete="off" />
						</div>
						<label class="control-label col-sm-3 col-md-3 col-lg-3" for="lastlogindate">Login lần cuối</label>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<input type="text" class="form-control input-sm" name="data[lastlogindate]" value="<?php echo date_format(date_create($recs->LastLoginDate), 'd-m-Y'); ?>" class="form-control" disabled autocomplete="off" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3 col-md-3 col-lg-3" for="phone">Số điện thoại</label>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<input type="text" class="form-control input-sm" name="data[phone]" value="<?php echo $recs->Phone; ?>" class="form-control" autocomplete="off" />
						</div>
						<label class="control-label col-sm-3 col-md-3 col-lg-3" for="id">Số CMND</label>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<input type="text" class="form-control input-sm" name="data[id]" value="<?php echo $recs->ID; ?>" class="form-control" autocomplete="off" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3 col-md-3 col-lg-3" for="email">Email</label>
						<div class="col-sm-9 col-md-9 col-lg-9">
							<input type="text" class="form-control input-sm" name="data[email]" value="<?php echo $recs->Email; ?>" class="form-control" autocomplete="off" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3 col-md-3 col-lg-3" for="address">Địa chỉ</label>
						<div class="col-sm-9 col-md-9 col-lg-9">
							<textarea class="form-control" rows="2" name="data[address]"><?php echo $recs->Address; ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3 col-md-3 col-lg-3" for="city">Tỉnh/TP</label>
						<div class="col-sm-9 col-md-9 col-lg-9">
							<input type="text" class="form-control input-sm" name="data[city]" value="<?php echo $recs->City; ?>" class="form-control" autocomplete="off" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3 col-md-3 col-lg-3" for="state">Quận/Huyện</label>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<input type="text" class="form-control input-sm" name="data[state]" value="<?php echo $recs->State; ?>" class="form-control" autocomplete="off" />
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<input type="submit" name="saveedit" value="Cập nhật" class="btn btn-primary btn-sm btn-block" />
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<a href="admin/members/display" class="btn btn-primary btn-sm btn-block">Hủy bỏ</a>
						</div>
					</div>
				</div><!--Hết phần bên trái-->
				
				<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 "><!--Phần bên phải-->
					<div class="form-group">
						<label class="control-label col-sm-3 col-md-3 col-lg-3" for="username">Tên tài khoản</label>
						<div class="col-sm-9 col-md-9 col-lg-9">
							<input type="text" class="form-control input-sm" name="data[username]" value="<?php echo $recs->FirstName; ?>" class="form-control" disabled autocomplete="off" />
						</div>
					</div>
					<div class="form-group <?php if(form_error('data[pass]')) echo "has-error has-feedback"; ?>">
						<label class="control-label col-sm-3 col-md-3 col-lg-3" for="pass">Mật khẩu</label>
						<div class="col-sm-9 col-md-9 col-lg-9">
							<input type="password" class="form-control input-sm" name="data[pass]" value="<?php echo $recs->Password; ?>" class="form-control" autocomplete="off" />
							<?php if(form_error('data[pass]')): ?>
							<span class="glyphicon glyphicon-remove form-control-feedback"></span>
							<?php endif; ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3 col-md-3 col-lg-3" for="creditlimit">Hạn mức nợ</label>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<input type="text" class="form-control input-sm" name="data[creditlimit]" value="<?php echo number_format($recs->CreditLimit); ?>" class="form-control" autocomplete="off" disabled />
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3 <?php if(form_error('data[creditlimitadd]')) echo "has-error has-feedback"; ?>">
							<input type="text" class="form-control input-sm" name="data[creditlimitadd]" value="0" autocomplete="off" />
							<?php if(form_error('data[creditlimitadd]')): ?>
							<span class="glyphicon glyphicon-remove form-control-feedback"></span>
							<?php endif; ?>
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<input type="submit" name="creditlimit" value="Giới hạn" class="btn btn-primary btn-sm btn-block" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3 col-md-3 col-lg-3" for="debit">Tiền nợ</label>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<input type="text" class="form-control input-sm debit" name="data[debit]" value="<?php echo number_format($recs->Debit); ?>" class="form-control" autocomplete="off" disabled />
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3 <?php if(form_error('data[debitadd]')) echo "has-error has-feedback"; ?>">
							<input type="text" class="form-control input-sm debitadd" name="data[debitadd]" value="0" class="form-control" autocomplete="off" />
							<?php if(form_error('data[debitadd]')): ?>
							<span class="glyphicon glyphicon-remove form-control-feedback"></span>
							<?php endif; ?>
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<input type="submit" name="debitmoney" value="Ghi nợ" class="btn btn-primary btn-sm btn-block" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3 col-md-3 col-lg-3" for="usermoneypaid">Tiền đã nạp</label>
						<div class="col-sm-6 col-md-6 col-lg-6">
							<input type="text" class="form-control input-sm" name="data[usermoneypaid]" value="<?php echo number_format($recs->MoneyPaid); ?>" class="form-control" disabled autocomplete="off" />
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<input type="submit" name="removedebit" value="Trả nợ" class="btn btn-primary btn-sm btn-block" <?php if(($recs->Debit) <=0) echo "disabled='disabled'"; ?> />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3 col-md-3 col-lg-3" for="moneyused">Tiền đã dùng</label>
						<div class="col-sm-9 col-md-9 col-lg-9">
							<input type="text" class="form-control input-sm" name="data[moneyused]" value="<?php echo number_format((($recs->MoneyPaid + $recs->FreeMoney) - ($recs->RemainMoney + $recs->MoneyTransfer))); ?>" class="form-control" autocomplete="off" disabled />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3 col-md-3 col-lg-3" for="remainmoney">Tiền còn lại</label>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<input type="text" class="form-control input-sm" name="data[remainmoney]" value="<?php echo number_format($recs->RemainMoney); ?>" class="form-control" autocomplete="off" disabled />
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3 <?php if(form_error('data[remainmoneyadd]')) echo "has-error has-feedback"; ?>">
							<input type="text" class="form-control input-sm" name="data[remainmoneyadd]" value="0" class="form-control" autocomplete="off" autofocus />
							<?php if(form_error('data[remainmoneyadd]')): ?>
							<span class="glyphicon glyphicon-remove form-control-feedback"></span>
							<?php endif; ?>
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<input type="submit" name="addmoney" value="Nạp tiền" class="btn btn-primary btn-sm btn-block" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3 col-md-3 col-lg-3" for="freemoney">Tiền được tặng</label>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<input type="text" class="form-control input-sm" name="data[freemoney]" value="<?php echo number_format($recs->FreeMoney); ?>" class="form-control" autocomplete="off" disabled />
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3 <?php if(form_error('data[freemoneyadd]')) echo "has-error has-feedback"; ?>">
							<input type="text" class="form-control input-sm" name="data[freemoneyadd]" value="0" class="form-control" autocomplete="off" />
							<?php if(form_error('data[freemoneyadd]')): ?>
							<span class="glyphicon glyphicon-remove form-control-feedback"></span>
							<?php endif; ?>
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<input type="submit" name="freemoney" value="Tặng tiền" class="btn btn-primary btn-sm btn-block" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3 col-md-3 col-lg-3" for="moneytransfer">Tiền đã chuyển</label>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<input type="text" class="form-control input-sm" name="data[moneytransfer]" value="<?php echo number_format($recs->MoneyTransfer); ?>" class="form-control" autocomplete="off" disabled />
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<input type="text" class="form-control input-sm" name="data[moneytransferto]" value="0" class="form-control" autocomplete="off" />
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<input type="submit" name="transfermoney" value="Chuyển tiền" class="btn btn-primary btn-sm btn-block" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3 col-md-3 col-lg-3" for="userto">Tài khoản đến</label>
						<div class="col-sm-9 col-md-9 col-lg-9">
							<select class="form-control input-sm" name="data[useridto]">
							<?php
								foreach($recsall as $key => $value)
								{
									if($value->userid != $recs->UserId)
									{
										if($value->firstname) echo "<option value=$value->userid>$value->firstname</option>";
										else echo "<option value=$value->userid>$value->username</option>";
									}
								}
							?>
							</select>
						</div>
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>
	</div>
	<?php echo form_close(); ?>
</section><!-- /.content -->