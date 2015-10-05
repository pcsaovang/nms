<script type="text/javascript">
	$(document).ready(function(){
		$('.eventdateend').datepicker({
			format: "dd-mm-yyyy",
			todayBtn: "linked",
			language: "vi",
			autoclose: true,
			todayHighlight: true
		});
		$('.eventtimeend').inputmask("99:99:99");
		$('.eventtimebegin').inputmask("99:99:99");
	})
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>CẤU HÌNH<small>Cấu hình hệ thống</small></h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#">Examples</a></li>
		<li class="active">Blank page</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
		<!-- Default box -->
			<?php echo form_open("admin/config/update", 'class=form-inline'); ?>
			<div class="box box-primary">
				<div class="box-header"></div><!-- /.box-header -->
				<div class="box-body">
					<?php //echo $this->session->flashdata('errors'); ?>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
							<table class="table table-condensed">
								<tr>
									<td class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><label for="sitename">Tiêu đề website</label></td>
									<td class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
										<input size="50px" type="text" name="sitename" class="form-control input-sm" value="<?php //echo $this->config->item('site_name'); ?>" autocomplate="off" />
									</td>
								</tr>
								<tr>
									<td class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><label for="sitename">Địa chỉ website</label></td>
									<td class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
										<input size="50px" type="text" name="sitedescription" class="form-control input-sm" value="<?php //echo $this->config->item('site_url'); ?>" autocomplate="off" />
									</td>
								</tr>
								<tr>
									<td class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><label for="sitename">Bắt đầu event</label></td>
									<td class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<?php //$start = json_decode($this->config->item('event_time')); ?>
											<input size="10px" type="text" name="eventdatebegin" class="form-control input-sm eventdatebein" value="<?php //echo date('d-m-Y', $start->start); ?>" autocomplate="off" />
										</div>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-clock-o"></i>
											</div>
											<input size="10px" type="text" name="eventtimebegin" class="form-control input-sm eventtimebegin" value="<?php //echo date('H:i:s', $start->start); ?>" autocomplate="off" />
										</div>
									</td>
								</tr>
								<tr>
									<td class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><label for="sitename">Kết thúc event</label></td>
									<td class="col-xs-8 col-sm-8 col-md-8 col-lg-8 dateevent">
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input size="10px" type="text" name="eventdateend" class="form-control input-sm eventdateend" value="<?php //echo date('d-m-Y', $start->end); ?>" autocomplate="off" />
										</div>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-clock-o"></i>
											</div>
											<input size="10px" type="text" name="eventtimeend" class="form-control input-sm eventtimeend" value="<?php //echo date('H:i:s', $start->end); ?>" autocomplate="off" />
										</div>
									</td>
								</tr>
							</table>
							
							<hr />
							<div class="panel panel-default">
							<div class="panel-heading">Quy đổi dựa trên lần nạp tiền của hội viên.</div>
							<div class="table-responsive">
								<table class="table table-condensed">
									<thead>
										<tr><th>Nạp từ</th><th>Đến</th><th>Quy đổi</th></tr>
									</thead>
									<tbody>
										<?php //$prize = json_decode($this->config->item('event_trans')); ?>
										<?php //foreach($prize as $key => $val) :?>
										<tr>
											<td>
												<div class="input-group">
													<input type="text" name="from[]" class="form-control input-sm text-right" value="<?php //echo number_format($val->from); ?>" autocomplate="off" />
													<div class="input-group-addon">
														<i class="glyphicon glyphicon-usd"></i>
													</div>
												</div>
											</td>
											<td>
												<div class="input-group">
													<input type="text" name="to[]" class="form-control input-sm text-right" value="<?php //echo number_format($val->to); ?>" autocomplate="off" />
													<div class="input-group-addon">
														<i class="glyphicon glyphicon-usd"></i>
													</div>
												</div>
											</td>
											<td>
												<div class="input-group">
													<input type="text" name="trans[]" class="form-control input-sm text-right" value="<?php //echo $val->trans; ?>" autocomplate="off" />
													<div class="input-group-addon">
														<i class="fa fa-crosshairs"></i>
													</div>
												</div>
											</td>
										</tr>
										<?php //endforeach; ?>
									</tbody>
								</table>
							</div>
							</div>
						</div>
						
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
							<div class="panel panel-default">
							<div class="panel-heading">Tùy chỉnh tỷ lệ trúng giải và số lượng giải.</div>
							<div class="table-responsive">
								<table class="table table-condensed">
									<thead>
										<tr><th>Tên giải</th><th>Số lượng giải</th><th>Tỷ lệ trúng</th></tr>
									</thead>
									<tbody>
										<?php
											//$prize = json_decode($this->config->item('event_prize'));
											//foreach($prize as $key => $val){
										?>
										<tr>
											<td><input type="text" name="name[]" class="form-control input-sm" value="<?php //echo $val->name; ?>" autocomplate="off" /></td>
											<td>
												<div class="input-group">
													<input type="text" name="number[]" class="form-control input-sm  text-right" value="<?php //echo $val->number; ?>" autocomplate="off" />
													<div class="input-group-addon">
														<i class="fa fa-gift"></i>
													</div>
												</div>
											</td>
											<td>
												<div class="input-group">
													<input type="text" name="hitrate[]" class="form-control input-sm  text-right" value="<?php //echo $val->hitrate; ?>" autocomplate="off" />
													<span class="input-group-addon">%</span>
												</div>
											</td>
										</tr>
										<?php //} ?>
									</tbody>
								</table>
							</div>
							</div>
						</div>
					</div>
				</div><!-- .box-body -->
				<div class="box-footer clearfix text-right"><input type="submit" name="update" value="Update" class="btn btn-primary btn-sm" /></div><!-- .box-footer clearfix -->
			<?php echo form_close(); ?>
			</div><!-- /.box -->
		</div> <!-- .col-xs-12 -->
	</div><!-- .row -->
</section><!-- /.content -->