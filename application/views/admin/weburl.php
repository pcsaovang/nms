<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>WEB URL<small>Nhật ký web</small></h1>
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
							<form action="admin/history/weburl_search" method="post" class="form-horizontal">
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
									<th>ID</th>
									<th>Url</th>
									<th>Ngày</th>
									<th>Người dùng</th>
									<th>Máy sử dụng</th>
								</tr>
							</<thead>
							<tbody>
								<?php foreach($recs as $rec): ?>
								<tr>
									<td><?php echo $rec->urlid; ?></td>
									<td><a href="<?php echo $rec->url; ?>" target="_bank"><?php echo substr($rec->url, 0, 60); ?></a></td>
									<td><?php echo $rec->recorddate; ?></td>
									<td><?php if(!empty($rec->firstname)){echo $rec->firstname;} else{echo $rec->machine;} ?></td>
									<td><?php echo $rec->machine; ?></td>
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