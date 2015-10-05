<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>MÁY CHỦ<small>Nhật ký máy chủ</small></h1>
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
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-bordered table-condensed table-hover table-striped">
							<thead>
								<tr>
									<th>Trạng thái</th>
									<th>Ngày</th>
									<th>Giờ</th>
									<th>Ghi chú</th>
								</tr>
							</<thead>
							<tbody>
								<?php foreach($recs as $rec): ?>
								<tr>
									<td><?php echo $rec->Status; ?></td>
									<td><?php echo $rec->RecordDate; ?></td>
									<td><?php echo $rec->RecordTime; ?></td>
									<td><?php echo $rec->Note; ?></td>
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