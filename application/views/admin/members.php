<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>HỘI VIÊN<small>Danh sách hội viên</small></h1>
	<ol class="breadcrumb">
		<li><a href="admin"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Hội viên</li>
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
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
							<form action="admin/members/search" method="post" class="form-inline">
								<div class="form-group">
									<div class="input-group">
										<input type="text" name="membername" id="membername" class="form-control input-sm" value="<?php if($query_string == "all") {echo "";} else {echo $query_string;} ?>"  placeholder="Tìm tên hội viên" autocomplete="off" />
										<span class="input-group-btn">
											<input type="submit" name="action" value="Tìm" class="btn btn-primary btn-sm" />
										</span>
									</div>
								</div>
							</form>
						</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
							<form action="admin/members/action" method="post" class="form-inline">
							<div class="form-group">
								<div class="input-group">
									<select class="form-control input-sm" name="option">
										<option value="delete">Xóa hội viên</option>
										<option value="addmoney">Sửa hội viên</option>
									</select>
									<span class="input-group-btn">
										<input type="submit" name="action" value="Action" class="btn btn-primary btn-sm" />
									</span>
								</div>
							</div>
						</div>
						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 text-right">
							Tổng nợ: <b><?php echo number_format($total_debit); ?></b> đồng.
							Tổng tiền còn: <b><?php echo number_format($total_money); ?></b> đồng.
						</div>
					</div>
				</div><!-- /.box-header -->
				<div class="box-body">
					<script type="text/javascript">
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
					<div class="table-responsive">
						<table class="table table-bordered table-condensed table-hover table-striped dataTable" id="tbl">
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
									<td><a href="admin/members/edituser/<?php echo $rec->userid; ?>"><?php if($rec->firstname){echo $rec->firstname;} else{echo $rec->username;} ?></a></td>
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
						</table><!-- .table table-bordered table-condensed table-hover table-striped -->
					</div>
				</div><!-- .box-body -->
				<div class="box-footer clearfix">
					<div class="row">
						<div class="col-xs-6">
							<?php $record = ($limit > $num_results) ? $num_results : $limit; ?>Hiển thị: <?php echo $offset." đến ".$record; ?> của: <?php echo $num_results; ?>
						</div>
						<div class="col-xs-6">
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