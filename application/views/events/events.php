<div class="row">
	<script type="application/javascript" src="template/js/spinwheel.1.1.3.js"></script>
	<script type="text/javascript" src="template/js/event.js"></script>
	<script type="text/javascript">
		var spinSecret = "<?php echo $spinSecret; ?>";
		var t = <?php echo $turn; ?>;
	</script>
	
	<div id="box_quayso">
		<div>
			<strong id="turn"><?php if($turn > 0): ?>Bạn còn: <?php echo $turn; ?> lượt quay.<?php endif; ?></strong>
			<strong id="game-message"></strong>
		</div>
		<hr />
		<div class="bg_quayso" style="/*background: url(template/img/event/BKG.jpg) no-repeat !important;*/ background-color: red;">
			<div class="large-12" style="text-align:center;padding:20px 0 0 0 0;z-index:15;position:relative">
				<img src="template/img/event/arrow.png" alt="Vòng quay may mắn" style="width:32px;">
			</div>
			<div id="box_ctquayso" style="text-align: center;">
				<canvas id="wheelcanvas" style="cursor:pointer;" width="450" height="450">Xin lổi, chúng tôi chưa hổ trợ trình duyệt của bạn.</canvas>
			</div>
		</div>
		<h2 id="game-message"></h2>
	</div>
	<small>
	<p> Lượt quay trúng thưởng chỉ xác định sau khi vòng quay dừng và có hiện quà trúng thưởng tương ứng.</p>
	<p>Phần thưởng tiền được cộng tự động vào tài khoản CSM của bạn. Vui lòng đăng xuất đăng nhập lại CSM để cập nhật.</p>
	</small>
</div>