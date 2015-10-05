<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>HỆ THỐNG<small>Nhật ký hệ thống</small></h1>
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
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<form action="admin/history/systemlog_search" method="post" class="form-horizontal">
								<div class="form-group">
									<label class="control-label col-xs-2 col-sm-2 col-md-2 col-lg-2" for="datefrom">Từ ngày</label>
									<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
										<input type="text" name="datefrom" id="datefrom" class="form-control input-sm" value="<?php echo date('d-m-Y', $string_txt[0]); ?>" autocomple="off" />
									</div>

									<label class="control-label col-xs-2 col-sm-2 col-md-2 col-lg-2" for="dateto">Đến ngày</label>
									<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
										<input type="text" name="dateto" id="dateto" class="form-control input-sm" value="<?php echo date('d-m-Y', $string_txt[1]); ?>" autocomple="off" />
									</div>
									
									<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
									<div class="btn-group">
										<input type="submit" name="filter" value="Tìm kiếm" class="btn btn-primary btn-sm" />
										<input type="submit" name="action" value="Xử lý" class="btn btn-primary btn-sm" />
									</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div><!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-bordered table-condensed table-hover table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Máy</th>
									<th>Người dùng</th>
									<th>IP</th>
									<th>Ngày vào</th>
									<th>Giờ vào</th>
									<th>Ngày ra</th>
									<th>Giờ ra</th>
									<th>Trạng thái</th>
									<th>Thời gian dùng</th>
									<th>Chi phí</th>
								</tr>
							</<thead>
							<tbody>
								<?php foreach($recs as $rec): ?>
								<tr <?php if((substr($rec->entertime, 0, 2) < 8) || (substr($rec->entertime, 0, 2) >= 22)) echo "class=danger"; ?>>
									<td><?php echo $rec->systemlogid; ?></td>
									<td><?php echo $rec->machinename; ?></td>
									<td><?php if($rec->firstname){echo $rec->firstname;} else{echo $rec->username;} ?></td>
									<td><?php echo $rec->ipaddress; ?></td>
									<td><?php echo $rec->enterdate; ?></td>
									<td><?php echo $rec->entertime; ?></td>
									<td><?php echo $rec->enddate; ?></td>
									<td><?php echo $rec->endtime; ?></td>
									<td><?php if($rec->status == 1){echo "Sẳn sàng";}elseif($rec->status == 2){echo "Mất kết nối";}elseif($rec->status == 3){echo "Đang sử dụng";}elseif($rec->status == 4){echo "Cảnh báo";} ?></td>
									<td class="text-right"><?php echo $rec->timeused; ?> phút</td>
									<td class="text-right"><?php echo number_format($rec->moneyused); ?></td>
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