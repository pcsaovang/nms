<script src="public/js/dashboard.js" type="text/javascript"></script>
<script src="plugins/chartjs/Chart.js" type="text/javascript"></script>
<script type="text/javascript">
	var salesChartData = {
		labels: <?php echo $group_date; ?>,
		datasets: 
		[{
			label: "Digital Goods",
			fillColor: "rgba(151,187,205,0.2)",
			strokeColor: "rgba(151,187,205,1)",
			pointColor: "rgba(151,187,205,1)",
			pointStrokeColor: "#fff",
			pointHighlightFill: "#fff",
			pointHighlightStroke: "rgba(151,187,205,1)",
			data: <?php echo $ret; ?>
		}]
	};
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#top_option").change(function(){
			var option = $("#top_option").val();
			$("#topdata").html("");
			$.ajax({
				url: 'admin/home/top_payment/' + option + '/ajax',
				dataType: 'html'
			}).done(function(data){
				$("#toppayment").html(data);
			});
		});
		
		$("#top_service").change(function(){
			var option = $("#top_service").val();
			$("#topservice").html("");
			
			$.ajax({
				url: 'admin/home/top_service/' + option + '/ajax',
				dataType: 'html'
			}).done(function(data){
				$("#topservice").html(data);
			});
		});
	})
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Trang chủ<small>Thống kê hệ thống</small></h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#">Examples</a></li>
		<li class="active">Blank page</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
		<!-- Default box -->
			<div class="box box-primary">
				<div class="box-body">
					<div class="row">
						<div class="col-md-8">
							<div class="box box-solid bg-maroon-gradient">
								<div class="row">
									<div class="col-md-12 text-center"><strong>Giao dịch: <?php echo $group_title; ?></strong></div>
								</div>
								<div class="row chart-responsive">
									<!-- Sales Chart Canvas -->
									<canvas id="salesChart" height="180"></canvas>
								</div><!-- /.chart-responsive -->
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="box box-solid bg-teal-gradient">
										<div class="box-header">
											<h3 class="box-title">Top nạp tiền</h3>
											<div class="box-tools pull-right">
												<select class="form-control input-sm pull-right" name="top_option" id="top_option">
													<option value="week">Tuần</option>
													<option value="month">Tháng</option>
												</select>
											</div>
										</div><!-- /.box-header -->
										<div class="box-body" id="toppayment"><?php echo $toppayment; ?></div>
										<div class="box-footer clearfix">Footer</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="box box-solid bg-green-gradient">
										<div class="box-header">
											<h3 class="box-title">Top dịch vụ</h3>
											<div class="box-tools pull-right">
												<select class="form-control input-sm pull-right" name="top_service" id="top_service">
													<option value="month">Tháng</option>
													<option value="week">Tuần</option>
												</select>
											</div>
										</div><!-- /.box-header -->
										<div class="box-body" id="topservice"><?php echo $topservice; ?></div>
										<div class="box-footer clearfix">Footer</div>
									</div>
								</div>
							</div>
						</div><!-- /.col -->
						<div class="col-md-4">
							<!-- TABLE: LATEST ORDERS -->
							<div class="box box-solid bg-aqua-gradient">
								<div class="box-header with-border">
									<h3 class="box-title">Dịch vụ</h3>
								</div><!-- /.box-header -->
								<div class="box-body"><?php echo $service; ?></div>
								<div class="box-footer clearfix">Footer</div><!-- /.box-footer -->
							</div><!-- /.box -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- .box-body -->
				<div class="box-footer clearfix">
					Footer
				</div><!-- .box-footer clearfix -->
			</div><!-- /.box -->
		</div> <!-- .col-xs-12 -->
	</div><!-- .row -->
</section><!-- /.content -->