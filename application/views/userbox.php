<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">
			<small><strong><?php echo $user_info[0]->firstname; ?></strong> 
			<i>(<?php echo $user_info[0]->pricetype; ?>)</i> 
			<a href="auth/logout" alt="Đăng xuất">Đăng xuất</a></small>
		</h4>
	</div>
	<div class="panel-body">
		<p>Tiền đã nạp: <strong><?php echo number_format($user_info[0]->moneypaid); ?></strong></p>
		<p>Tiền còn lại: <strong><?php echo number_format($user_info[0]->remainmoney); ?></strong></p>
		<p>Tiền được miễn phí: <strong><?php echo number_format($user_info[0]->freemoney); ?></strong></p>
		<p>Tiền nợ: <strong><?php echo number_format($user_info[0]->debit); ?></strong></p>
		<?php if(isset($turn) && $turn > 0): ?>
		<p>Bạn có: <strong><?php echo $turn; ?> </strong>lần quay số. <a href="home/saveturn" title="Nhận lần quay số" class="btn btn-default btn-sm">Nhận</a></p>
		<?php endif; ?>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">Chuyển tiền</div>
	<div class="panel-body">
		<?php echo $errors; ?>
		<form action="members/saveuser/<?php echo $this->auth['userid']; ?>" method="post" class="form-inline">
			<div class="form-group">
				<small>Tài khoản đến</small>
				<div class="input-group col-md-12" style="margin-bottom:10px;">
					<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
					<select class="form-control input-sm" name="data[useridto]">
						<optgroup label="Tài khoản đến">
						<?php foreach($user_other as $value): ?>
						<?php if($value->userid != $this->auth['userid']): ?>
						<option value="<?php echo $value->userid; ?>"><?php if($value->firstname){echo $value->firstname;} else{echo $value->username;} ?></option>
						<?php endif; ?>
						<?php endforeach; ?>
						</optgroup>
					</select>
				</div>
				
				<div class="input-group col-md-12" style="margin-bottom:10px;">
					<span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
					<input type="number" name="data[moneytransferto]" class="form-control input-sm" placeholder="Số tiền cần chuyển" autocomplete="off" />
					<input type="hidden" name="data[firstname]" value="<?php echo $this->auth['firstname']; ?>" />
				</div>
				
				<div class="input-group col-md-12" style="margin-bottom:10px;">
					<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
					<input type="password" name="data[pw]" class="form-control input-sm" placeholder="Nhập lại mật khẩu" />
				</div>
				<div class="input-group col-md-12 text-center">
					<input type="submit" name="transfermoney" value="Chuyển tiền" class="btn btn-default btn-sm btn-block" />
				</div>
			</div>
		</form>
	</div>
</div>