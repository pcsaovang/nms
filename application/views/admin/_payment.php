<div class="panel panel-primary">
<div class="panel-heading">Nhật ký giao dịch</div>
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
		  <li class="active"><a href="admin/history/payment">Giao dịch <span class="glyphicon glyphicon-shopping-cart"></span></a></li>
		  <li><a href="admin/history/service">Dịch vụ <span class="glyphicon glyphicon-gift"></span></a></li>
		  <li><a href="admin/history/weburl">Web URL <span class="glyphicon glyphicon-magnet"></span></a></li>
		  <li><a href="admin/history/serverlog">Máy chủ <span class="glyphicon glyphicon-tasks"></span></a></li>
		  <li><a href="admin/history/systemlog">Hệ thống <span class="glyphicon glyphicon-book"></span></a></li>
		</ul>
	<div class="tab-content">
	<div class="tab-pane active">
		<div class="row" style="padding-top: 10px;">
			<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
				<form action="admin/history/search_payment" method="post" class="form-horizontal">
					<div class="form-group">
						<label class="control-label col-xs-2 col-sm-2 col-md-2 col-lg-2" for="datefrom">Từ ngày</label>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
							<input type="text" name="datefrom" id="datefrom" class="form-control input-sm" value="<?php echo date('d-m-Y', $string_txt[0]); ?>" autocomple="off" />
						</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
							<input type="tex" name="timefrom" class="form-control input-sm" value="<?php echo date('H:i:s', $string_txt[0]); ?>" autocomple="off" />
						</div>
					
						<label class="control-label col-xs-2 col-sm-2 col-md-2 col-lg-2" for="dateto">Đến ngày</label>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
							<input type="text" name="dateto" id="dateto" class="form-control input-sm" value="<?php echo date('d-m-Y', $string_txt[1]); ?>" autocomple="off" />
						</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
							<input type="tex" name="timeto" class="form-control input-sm" value="<?php echo date('H:i:s', $string_txt[1]); ?>" autocomple="off" />
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
							<input type="submit" name="filter" value="Tìm kiếm" class="btn btn-default btn-sm" />
							<input type="submit" name="action" value="Xử lý" class="btn btn-default btn-sm" />
						</div>
						</div>
					</div>
				</form>
			</div>
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
				<h4><span class="label label-info">Doanh thu: <?php echo number_format($total['total_money']); ?></span></h4>
				<h4><span class="label label-info">Dịch vụ: <?php echo number_format($total['total_money_service']); ?></span></h4>
				<h4><span class="label label-info">Khách nợ: <?php echo number_format($total['total_money_debit']); ?></span></h4>
				<h4><span class="label label-info">Trả nợ: <?php echo number_format($total['total_money_undebit']); ?></span></h4>
			</div>
		</div>
		<div class="row">
		<div class="table-responsive" style="padding-top: 5px;">
			<table class="table table-bordered table-condensed table-hover table-striped" style="margin-bottom: 0px;" id="tbl">
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
					<td><?php if($rec->firstname) {echo $rec->firstname;} else{echo $rec->username;} ?></td>
					<td><?php echo $rec->voucherdate; ?></td>
					<td><?php echo $rec->vouchertime; ?></td>
					<td class="text-right"><?php echo number_format($rec->amount); ?></td>
					<td><?php echo $rec->staffname;//echo $rec->staffid; ?></td>
					<td><?php echo $rec->note; ?></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		</div>
	</div>
	</div>
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
<div class="panel-footer"><?php if(!empty($self)) echo '<span class="label label-success">'.$self.'&nbsp</span>'; ?></div>
</div>