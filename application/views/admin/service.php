<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>HỘI VIÊN<small>Danh sách hội viên</small></h1>
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
							<form action="admin/history/service_search" method="post" class="form-horizontal">
								<div class="form-group">
									<label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1" for="datefrom">Từ ngày</label>
									<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
										<input type="text" name="datefrom" id="datefrom" class="form-control input-sm" value="<?php echo date('d-m-Y', $string_txt[0]); ?>" autocomple="off" />
									</div>

									<label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1" for="dateto">Đến ngày</label>
									<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
										<input type="text" name="dateto" id="dateto" class="form-control input-sm" value="<?php echo date('d-m-Y', $string_txt[1]); ?>" autocomple="off" />
									</div>
									
									<label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1" for="dateto">Nhân viên</label>
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
									<div class="btn-group">
										<input type="submit" name="filter" value="Tìm kiếm" class="btn btn-primary btn-sm" />
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
									<th>Người mua</th>
									<th>Tên hàng</th>
									<th>Ngày</th>
									<th>Giờ</th>
									<th>Số lượng</th>
									<th>Thành tiền</th>
									<th>Đơn vị</th>
									<th>Nhân viên</th>
								</tr>
							</<thead>
							<tbody>
								<?php foreach($recs as $rec): ?>
								<tr>
									<td><?php if($rec->firstname){echo $rec->firstname;} else{echo $rec->username;} ?></td>
									<td><?php echo $rec->servicename; ?></td>
									<td><?php echo $rec->servicedate; ?></td>
									<td><?php echo $rec->servicetime; ?></td>
									<td class="text-right"><?php echo $rec->servicequantity; ?></td>
									<td class="text-right"><?php echo number_format($rec->serviceamount); ?></td>
									<td><?php echo $rec->unit; ?></td>
									<td><?php echo $rec->staffname; ?></td>
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