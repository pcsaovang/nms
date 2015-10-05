<div class="row">
	<div class="col-md-12"><?php echo $box_events; ?></div>
</div>
<hr />
<div class="row">
	<div class="col-md-12"><?php echo $box_google; ?></div>
</div>
<div class="row">
	<div class="col-md-12">
		<h4 class="page-title">Danh mục website</h1>
		<ul class="favi_big">
			<?php foreach($list_icon_url as $value): ?>
			<li>
				<a href="<?php echo $value->url; ?>" title="<?php echo $value->description; ?>" target="_blank">
					<div class="ico_web">
						<img src="<?php echo $value->iconurl; ?>" width="48" height="48" alt="<?php echo $value->description; ?>" />
					</div>
					<p class="name"><?php echo $value->title; ?></p>
				</a>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>