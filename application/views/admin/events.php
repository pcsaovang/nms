<script type="text/javascript">
	$(document).ready(function(){
		$('.eventdateend').datepicker({
			format: "yyyy-mm-dd",
			todayBtn: "linked",
			language: "vi",
			autoclose: true,
			todayHighlight: true
		});
		$('.eventdatebein').datepicker({
			format: "yyyy-mm-dd",
			todayBtn: "linked",
			language: "vi",
			autoclose: true,
			todayHighlight: true
		});
		$('.eventtimeend').inputmask("99:99:99");
		$('.eventtimebegin').inputmask("99:99:99");
	})
</script>
<section class="content-header">
	<h1>SỰ KIỆN<small>Cấu hình sự kiện</small></h1>
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
			<div class="box box-primary">
				<div class="box-header"></div><!-- /.box-header -->
				<div class="box-body">
					<?php echo $this->session->flashdata('errors'); ?>
					<div class="row">
						<?php echo form_open("admin/events/trans", 'class=form-inline'); ?>
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
							<div class="panel panel-default">
								<div class="panel-heading">Quy đổi dựa trên lần nạp tiền của hội viên.</div>
								<div class="table-responsive">
									<table class="table table-condensed">
										<thead>
											<tr><th>Nạp từ</th><th>Đến</th><th>Quy đổi</th></tr>
										</thead>
										<tbody>
											<?php foreach($trans as $val): ?>
											<tr>
												<td>
													<div class="input-group">
														<input type="text" name="from[]" class="form-control input-sm text-right" value="<?php echo $val->from; ?>" autocomplete="off" />
														<div class="input-group-addon">
															<i class="glyphicon glyphicon-usd"></i>
														</div>
													</div>
												</td>
												<td>
													<div class="input-group">
														<input type="text" name="to[]" class="form-control input-sm text-right" value="<?php echo $val->to; ?>" autocomplete="off" />
														<div class="input-group-addon">
															<i class="glyphicon glyphicon-usd"></i>
														</div>
													</div>
												</td>
												<td>
													<div class="input-group">
														<input type="text" name="trans[]" class="form-control input-sm text-right" value="<?php echo $val->trans; ?>" autocomplete="off" />
														<div class="input-group-addon">
															<i class="fa fa-crosshairs"></i>
														</div>
													</div>
												</td>
											</tr>
											<?php endforeach; ?>
											<tr>
												<td>
													<span>Trên: </span>
													<div class="input-group">
														<input size="5px" type="text" name="frommax" class="form-control input-sm text-right" value="50000" autocomplete="off" />
														<div class="input-group-addon">
															<i class="glyphicon glyphicon-usd"></i>
														</div>
													</div>
												</td>
												<td colspan="2">
													<div class="input-group">
														<input size="5px" type="text" name="transmax" class="form-control input-sm text-right" value="5000" autocomplete="off" />
														<div class="input-group-addon">
															<i class="glyphicon glyphicon-usd"></i>
														</div>
													</div>
													<span> một lần quay</span>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="panel-footer text-right"><input type="submit" name="update" value="Update" class="btn btn-primary btn-sm" /></div>
							</div>
						</div>
						<?php echo form_close(); ?>
						<?php echo form_open("admin/events/update/$eventcode", 'class=form-inline'); ?>
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
							<div class="panel panel-default">
								<div class="panel-heading">Tùy chỉnh tỷ lệ trúng giải và số lượng giải.</div><br />
								<div class="table-responsive">
									<table class="table table-condensed">
										<tr>
											<td><label for="eventdatebegin">Bắt đầu</label></td>
											<td>
												<div class="input-group">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input size="10px" type="text" name="eventdatebegin" class="form-control input-sm eventdatebein" value="<?php echo $eventtime['start'][0]; ?>" autocomplete="off" />
												</div>
												<div class="input-group">
													<div class="input-group-addon">
														<i class="fa fa-clock-o"></i>
													</div>
													<input size="10px" type="text" name="eventtimebegin" class="form-control input-sm eventtimebegin" value="<?php echo $eventtime['start'][1]; ?>" autocomplete="off" />
												</div>
											</td>
											<td><label for="eventdateend">Kết thúc</label></td>
											<td>
												<div class="input-group">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input size="10px" type="text" name="eventdateend" class="form-control input-sm eventdateend" value="<?php echo $eventtime['end'][0]; ?>" autocomplete="off" />
												</div>
												<div class="input-group">
													<div class="input-group-addon">
														<i class="fa fa-clock-o"></i>
													</div>
													<input size="10px" type="text" name="eventtimeend" class="form-control input-sm eventtimeend" value="<?php echo $eventtime['end'][1]; ?>" autocomplete="off" />
												</div>
											</td>
										</tr>
									</table>
								</div>
								<div class="table-responsive">
									<table class="table table-condensed">
										<thead>
											<tr><th>Tên giải</th><th>Số lượng giải</th><th>Tỷ lệ trúng</th><th>Giá trị giải</th></tr>
										</thead>
										<tbody>
											<?php foreach($prize as $val): ?>
											<tr>
												<td>
													<input type="hidden" name="prizeid[]" class="form-control input-sm" value="<?php echo $val->EventPrize; ?>" autocomplete="off" />
													<input type="text" name="name[]" class="form-control input-sm" value="<?php echo $val->EventName; ?>" autocomplete="off" />
												</td>
												<td>
													<div class="input-group">
														<input type="text" name="number[]" class="form-control input-sm  text-right" value="<?php echo $val->EventNumber; ?>" autocomplete="off" />
														<div class="input-group-addon">
															<i class="fa fa-gift"></i>
														</div>
													</div>
												</td>
												<td>
													<div class="input-group">
														<input type="text" name="hitrate[]" class="form-control input-sm  text-right" value="<?php echo $val->EventHitrate; ?>" autocomplete="off" />
														<span class="input-group-addon">%</span>
													</div>
												</td>
												<td>
													<div class="input-group">
														<input type="text" name="money[]" class="form-control input-sm  text-right" value="<?php echo $val->EventMoney; ?>" autocomplete="off" />
														<span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
													</div>
												</td>
											</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
								<div class="panel-footer text-right"><input type="submit" name="update" value="Update" class="btn btn-primary btn-sm" /></div>
							</div>
						</div>
						<?php echo form_close(); ?>
					</div>
				</div><!-- .box-body -->
				<div class="box-footer clearfix text-right">Footer</div><!-- .box-footer clearfix -->
			</div><!-- /.box -->
		</div> <!-- .col-xs-12 -->
	</div><!-- .row -->
</section><!-- /.content -->