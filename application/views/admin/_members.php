<div class="panel panel-primary">
	<div class="panel-heading">Danh sách hội viên</div>
	<div class="panel-body">
		<div class="row" style="margin-bottom: 10px;">
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<form action="admin/members/search" method="post" class="form-inline">
				<div class="form-group">
				<input type="search" name="membername" id="membername" class="form-control input-sm" value="<?php if($query_string == "all") {echo "";} else {echo $query_string;} ?>" autocomplete="off" />
				<input type="submit" name="action" value="Tìm kiếm" class="btn btn-default btn-sm" />
				</form>
				</div>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
				<form action="admin/members/action" method="post" class="form-inline">
				<div class="form-group">
				<select class="form-control input-sm" name="option">
					<option value="delete">Xóa hội viên</option>
					<option value="addmoney">Sửa hội viên</option>
				</select>
				<input type="submit" name="action" value="Action" class="btn btn-default btn-sm" />
				</div>
			</div>
		</div>
		<script>
			$(document).ready(function(){
				
				var $tbl = $("#tbl");
				var $bodychk = $tbl.find('tbody input:checkbox');
				
				$(".checkall").click(function(){
					$(".check").prop('checked', $(this).prop('checked'));
				});
				
				$tbl.find('thead input:checkbox').change(function(){
					var c = this.checked;
					$bodychk.prop('checked', c);
					$bodychk.trigger('change');
				});
				
				$bodychk.on('change', function(){
					if($(this).is(':checked'))
					{
						$(this).closest('tr').addClass('active');
					}
					else
					{
						$(this).closest('tr').removeClass('active');
					}
				});
			});
		</script>
		<div class="row">
		<div class="table-responsive">
		<table class="table table-bordered table-condensed table-hover table-striped" style="margin-bottom: 0px;" id="tbl">
			<thead>
			<tr>
				<th class="text-center"><input type="checkbox" name="checkall" class="checkall" /></th>
				<?php foreach($fields as $field_name => $field_display): ?>
				<th <?php if($sort_by == $field_name) {echo "class=\"sorting_$sort_order\"";} else {echo "class=\"sorting\"";} ?>>
					<?php echo anchor("admin/members/display/$query_string/$field_name/".(($sort_order == 'asc' && $sort_by == $field_name) ? 'desc' : 'asc'), $field_display); ?>
				</th>
				<?php endforeach; ?>
			</tr>
			</thead>
			<tbody>
				<?php foreach($recs as $rec): ?>
				<tr>
					<td class="text-center"><input type="checkbox" name="id[]" value="<?php echo $rec->userid; ?>" class="check" /></td>
					<td><?php echo $rec->userid; ?></td>
					<td><?php if($rec->firstname){echo $rec->firstname;} else{echo $rec->username;} ?></td>
					<td class="text-right"><?php echo number_format($rec->debit); ?></td>
					<td class="text-right"><?php echo number_format($rec->moneypaid); ?></td>
					<td class="text-right"><?php echo number_format($rec->remainmoney); ?></td>
					<td><?php $d = date_create($rec->recorddate); echo date_format($d, 'd-m-Y'); ?></td>
					<td><?php $d = date_create($rec->lastlogindate); echo date_format($d, 'd-m-Y'); ?></td>
					<td><?php echo $rec->pricetype; ?></td>
					<td class="text-center"><span class="<?php if($rec->active){echo "glyphicon glyphicon-ok-circle";} else{echo "glyphicon glyphicon-ban-circle";} ?>"></span></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		</div>
		</div>
		</form><!-- form action -->
		<div class="row">
			<div class="col-md-12">
				<?php if(strlen($pagination)): ?>
				<?php echo $pagination; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="panel-footer">
		<div class="row">
		<div class="col-lg-4">
		<?php $record = ($limit > $num_results) ? $num_results : $limit; ?>Record: <?php echo $offset."/".$record; ?> Tổng: <?php echo $num_results; ?>
		</div>
		<div class="col-lg-4">Tổng nợ: <b><?php echo number_format($total_debit); ?></b> đồng.</div>
		<div class="col-lg-4">Tổng tiền còn: <b><?php echo number_format($total_money); ?></b> đồng.</div>
		</div>
	</div>
</div>