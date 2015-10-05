<form action="members/saveuser/<?php echo $this->auth['userid']; ?>" method="post">
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="panel-title row">
			<div class="col-md-6">Gọi dịch vụ</div>
			<div class="col-md-6 text-right"><input type="submit" name="payservice" value="Gọi" class="btn btn-default btn-sm" /></div>
		</div>
	</div>
	<div class="table-responsive">
		<table class="table no-margin table-hover">
			<thead>
				<tr>
					<th>Mặt hàng</th>
					<th class="text-right">ĐG</th>
					<th class="text-center">SL</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($listservice as $value): ?>	
				<tr>
					<td width="60%"><?php echo $value->ServiceName; ?></td>
					<td class="text-right" width="20%"><?php echo number_format($value->ServicePrice); ?></td>
					<td width="20%">
						<input type="text" name="servicenum[<?php echo $value->ServiceId; ?>]" class="form-control input-sm text-center" value="0" autocomplete="off" />
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
</form>