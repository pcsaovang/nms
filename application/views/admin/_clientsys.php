<div class="panel panel-primary">
	<div class="panel-heading">Quản lý máy trạm</div>
	<div class="panel-body">
		<div class="row">
			<div class="table-responsive">
				<table class="table table-bordered table-condensed table-hover table-striped" style="margin-bottom: 0px;" id="tbl">
					<thead>
						<tr>
							<th>Máy</th>
							<th>CPU</th>
							<th>RAM</th>
							<th>VGA</th>
							<th>NIC</th>
							<th>MAC</th>
						</tr>
					</<thead>
					<tbody>
						<?php foreach($recs as $rec): ?>
						<tr>
							<td><?php echo $rec->CPName; ?></td>
							<td><?php echo $rec->CPU; ?></td>
							<td><?php echo $rec->RAM; ?></td>
							<td><?php echo $rec->CardName; ?> (<?php echo $rec->VGAMem; ?>)</td>
							<td><?php echo $rec->NIC; ?></td>
							<td><?php echo $rec->MAC; ?></td>
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
	<div class="panel-footer">Footer</div>
</div>