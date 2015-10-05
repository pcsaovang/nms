<div class="panel panel-primary">
<div class="panel-heading">Nhật ký web</div>
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
		  <li><a href="admin/history/service">Dịch vụ <span class="glyphicon glyphicon-gift"></span></a></li>
		  <li class="active"><a href="admin/history/weburl">Web URL <span class="glyphicon glyphicon-magnet"></span></a></li>
		  <li><a href="admin/history/serverlog">Máy chủ <span class="glyphicon glyphicon-tasks"></span></a></li>
		  <li><a href="admin/history/systemlog">Hệ thống <span class="glyphicon glyphicon-book"></span></a></li>
		</ul>
	<div class="tab-content">
	<div class="tab-pane active">
		<div class="row" style="padding-top: 10px;">
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
							<input type="submit" name="filter" value="Tìm kiếm" class="btn btn-default btn-sm" />
							<input type="submit" name="action" value="Xử lý" class="btn btn-default btn-sm" />
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