<div class="table-responsive">
	<table class="table no-margin">
		<thead>
			<tr>
				<th class="text-center">ID</th>
				<th>Tên</th>
				<th class="text-right">Số tiền</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($row as $value): ?>
			<tr>
				<td class="text-center"><?php echo $value->userid; ?></td>
				<td><?php echo $value->firstname; ?></td>
				<td class="text-right"><?php echo number_format($value->total); ?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>