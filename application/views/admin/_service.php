<div class="panel panel-primary">
	<div class="panel-heading">Nhật ký dịch vụ</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<script>
					$(function(){
						var availableTags = ['a','b'];
						$( "#datefrom" ).datepicker({dateFormat: "dd-mm-yy"});
						$( "#dateto" ).datepicker({dateFormat: "dd-mm-yy"});
					});
				</script>
				<ul class="nav nav-tabs" role="tablist">
					  <li><a href="admin/history/payment">Giao dịch <span class="glyphicon glyphicon-shopping-cart"></span></a></li>
					  <li class="active"><a href="admin/history/service">Dịch vụ <span class="glyphicon glyphicon-gift"></span></a></li>
					  <li><a href="admin/history/weburl">Web URL <span class="glyphicon glyphicon-magnet"></span></a></li>
					  <li><a href="admin/history/serverlog">Máy chủ <span class="glyphicon glyphicon-tasks"></span></a></li>
					  <li><a href="admin/history/systemlog">Hệ thống <span class="glyphicon glyphicon-book"></span></a></li>
					</ul>
				<div class="tab-content">
					<div class="tab-pane active">
						<div class="row" style="padding-top: 10px;">
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
											<input type="submit" name="filter" value="Tìm kiếm" class="btn btn-default btn-sm" />
										</div>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="row">
							<div class="table-responsive" style="padding-top: 5px;">
								<table class="table table-bordered table-condensed table-hover table-striped" style="margin-bottom: 0px;" id="tbl">
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