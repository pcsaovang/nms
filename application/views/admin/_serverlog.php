<div class="panel panel-primary">
	<div class="panel-heading">Nhật ký máy chủ</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<ul class="nav nav-tabs" role="tablist">
				  <li><a href="admin/history/payment">Giao dịch <span class="glyphicon glyphicon-shopping-cart"></span></a></li>
				  <li><a href="admin/history/service">Dịch vụ <span class="glyphicon glyphicon-gift"></span></a></li>
				  <li><a href="admin/history/weburl">Web URL <span class="glyphicon glyphicon-magnet"></span></a></li>
				  <li class="active"><a href="admin/history/serverlog">Máy chủ <span class="glyphicon glyphicon-tasks"></span></a></li>
				  <li><a href="admin/history/systemlog">Hệ thống <span class="glyphicon glyphicon-book"></span></a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active">
						<div class="row">
							<div class="table-responsive" style="padding-top: 5px;">
								<table class="table table-bordered table-condensed table-hover table-striped" style="margin-bottom: 0px;" id="tbl">
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
								</table>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<?php if(strlen($pagination)): ?>
								<?php echo $pagination; ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="panel-footer">Footer</div>
</div>