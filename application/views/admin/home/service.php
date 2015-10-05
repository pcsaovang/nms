<div class="table-responsive">
	<table class="table no-margin">
		<thead>
			<tr>
				<th>Mặt hàng</th>
				<th class="text-right">Đơn giá</th>
				<th class="text-center">ĐVT</th>
				<th class="text-right">Tồn kho</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($row as $value): ?>
			<tr>
				<td><?php echo $value->ServiceName; ?></td>
				<td class="text-right"><?php echo number_format($value->ServicePrice); ?></td>
				<td class="text-center"><?php echo $value->Unit; ?></td>
				<td class="text-right"><?php echo $value->Inventory; ?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>