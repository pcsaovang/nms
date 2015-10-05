<script type="text/javascript">
	$(document).ready(function(){
		$('#datefrom input').datepicker({
			format: "dd-mm-yyyy",
			todayBtn: "linked",
			language: "vi",
			autoclose: true,
			todayHighlight: true
		});
	})
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>GIAO DỊCH<small>Nhật ký giao dịch</small></h1>
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
				<div class="box-header">
					<div class="row">
						<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
							<form action="admin/history/search_payment" method="post" class="form-horizontal">
								<div class="form-group">
									<label class="control-label col-xs-2 col-sm-2 col-md-2 col-lg-2" for="datefrom">Từ ngày</label>
									<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" id="datefrom">
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" name="datefrom" id="datefrom" class="form-control input-sm" value="<?php echo date('d-m-Y', $string_txt[0]); ?>" autocomple="off" />
										</div>
									</div>
									<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-clock-o"></i>
											</div>
											<input type="tex" name="timefrom" class="form-control input-sm" value="<?php echo date('H:i:s', $string_txt[0]); ?>" autocomple="off" />
										</div>
									</div>
								
									<label class="control-label col-xs-2 col-sm-2 col-md-2 col-lg-2" for="dateto">Đến ngày</label>
									<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" id="datefrom">
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" name="dateto" id="dateto" class="form-control input-sm" value="<?php echo date('d-m-Y', $string_txt[1]); ?>" autocomple="off" />
										</div>
									</div>
									<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-clock-o"></i>
											</div>
											<input type="tex" name="timeto" class="form-control input-sm" value="<?php echo date('H:i:s', $string_txt[1]); ?>" autocomple="off" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-xs-2 col-sm-2 col-md-2  col-lg-2" for="staff">Nhân viên</label>
									<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
										<select name="staff" class="form-control input-sm">
											<?php foreach($staff as $staffid): ?>
											<?php if($staffid->userid != 1): ?>
											<option value="<?php echo $staffid->userid; ?>"><?php echo $staffid->username; ?></option>
											<?php endif; ?>
											<?php endforeach; ?>
										</select>
									</div>
									<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
										<input type="tex" name="firstname" id="firstname" class="form-control input-sm" value="<?php if($string_txt[3] == 'all'){echo '';} else{echo $string_txt[3];} ?>" placeholder="Tìm tên..." autocomple="off" />
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
									<div class="btn-group">
										<input type="submit" name="filter" value="Tìm kiếm" class="btn btn-primary btn-sm" />
										<input type="submit" name="action" value="Xử lý" class="btn btn-primary btn-sm" />
									</div>
									</div>
								</div>
							</form>
						</div>
						<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
							<span class="text-green">Doanh thu: <?php echo number_format($total['total_money']); ?></span><br />
							<span class="text-green">Dịch vụ: <?php echo number_format($total['total_money_service']); ?></span><br />
							<span class="text-green">Khách nợ: <?php echo number_format($total['total_money_debit']); ?></span><br />
							<span class="text-green">Trả nợ: <?php echo number_format($total['total_money_undebit']); ?></span>
						</div>
					</div>
				</div><!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-bordered table-condensed table-hover table-striped">
							<thead>
								<tr>
									<?php foreach($fields as $field_name => $field_display): ?>
									<th <?php if($sort_by == $field_name) {echo "class=\"sorting_$sort_order\"";} else {echo "class=\"sorting\"";} ?>>
									<?php echo anchor("admin/history/payment/$query_string/$field_name/".(($sort_order == 'asc' && $sort_by == $field_name) ? 'desc' : 'asc'), $field_display); ?>
									</th>
									<?php endforeach; ?>
								</tr>
							</thead>
							<tbody>
								<?php foreach($recs as $rec): ?>
								<tr <?php if(($rec->vouchertime < '08:00:00') || ($rec->vouchertime > '22:00:00')) echo "class=danger"; ?>>
								<td>
									<a href="admin/members/edituser/<?php echo $rec->userid; ?>">
										<?php if($rec->firstname) {echo $rec->firstname;} else{echo $rec->username;} ?>
									</a>
								</td>
								<td><?php echo $rec->voucherdate; ?></td>
								<td><?php echo $rec->vouchertime; ?></td>
								<td class="text-right"><?php echo number_format($rec->amount); ?></td>
								<td><?php echo $rec->staffname;//echo $rec->staffid; ?></td>
								<td><?php echo $rec->note; ?></td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table><!-- table table-bordered table-condensed table-hover table-striped -->
					</div>
				</div><!-- .box-body -->
				<div class="box-footer clearfix">
					<div class="row">
						<div class="col-xs-12">
							<div class="dataTables_paginate paging_bootstrap">
								<?php if(strlen($pagination)): ?>
								<?php echo $pagination; ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div><!-- .box-footer clearfix -->
			</div><!-- /.box -->
		</div> <!-- .col-xs-12 -->
	</div><!-- .row -->
</section><!-- /.content -->