$(function(){
	$(document).ready(function(){
		var d = true;
		if(t > 0) d = false;
		else d = true;
		
		var processing = false;
		var wheel;
		function loadWheel(wheel){
			wheel = new SpinWheel({
				canvas: 'wheelcanvas',
				image: 'template/img/event/bg2.png',
				disabledImage: 'template/img/event/bg_dis.png',
				startImage: 'template/img/event/btn.png',
				fps: 120,
				disabled: d,
				click: function(){
					if(processing == true || false == true){
						return;
					}
					processing = true;
					wheel.spin();
					$("#game-message").html("");
					if($(".messages").length) {$(".messages").hide();}
					$.ajax({
						url: 'events/events/data_event',
						data: {s: spinSecret},
						type: 'POST',
						dataType: 'json',
						success: function(data){
							console.log(data);
							if(data.turns <= 0) $("#turn").html('Bạn còn: ' + (data.turns - 1) + ' lượt quay.');
							if(typeof data.code != 'undefined' && data.code == 1){
								spinSecret == data.spinSecret;
								wheel.spinToEnd(
									data.pos,
									function(){
										if(data.getprize){
											$.ajax(data.getprize, {
												type: 'GET',
												dataType: 'json',
												success: function(prizeResult){
													if(prizeResult === null || typeof prizeResult === 'undefined') {
														wheel.showAnimatedMessage('Xẩy ra lổi.');
														wheel.disable();
														return;
													}
													
													var message = data.message;
													
													if(data.turns == 0){
														$("#game-message").html(prizeResult.messages + "<br />Bạn đã hết lượt quay, vui lòng đổi lượt quay để tiếp tục");
													}
													else
													{
														setTimeout(function(){
															$("#game-message").html("Click vào vòng quay để tiếp tục săn giải thưởng");
															//loadWheel();
															window.location.reload();
														}, 5000);
														
														$("#game-message").html(prizeResult.messages + ". <a href='javascript:void(0);' onclick='location.reload(true); return false;' style='font-weight:bold;color:#F00'>Tiếp tục quay</a>");
														$("#wheelcanvas").click(function(){
															window.location.reload();
														});
													}
												},
												error: function(prizeResult){
													wheel.showAnimatedMessage('Xẩy ra lổi.');
													wheel.disable();
													$("#game-message").html("Có lổi khi nhận thưởng, vui lòng xem lại lịch sử.");
												}
											});
										}
										setTimeout(function(){
											wheel.showAnimatedMessage(data.message);
											//wheel.drawPrize(data.image);
											processing = false;
											wheel.disable();
										}, 500);
									}
								);
							}
							else
							{
								wheel.showAnimatedMessage('Xẩy ra lổi.');
								wheel.disable();
								if(typeof data.messages != 'undefined')
								{
									$("#game-message").html(data.messages + ". <a href='javascript:void(0);' onclick='location.reload(true);return false;' style='font-weight:bold;color:#F00'>Tiếp tục quay</a>");
								}
								else
								{
									$("#game-message").html("Vui lòng thử lại sau ít phút" + ". <a href='javascript:void(0);' onclick='location.reload(true);return false;' style='font-weight:bold;color:#F00'>Tiếp tục quay</a>");
								}
							}
							$("#remain-turns").html(data.turns);
						},
						complete: function(){

						},
						error: function(data){
							wheel.showAnimatedMessage('Xẩy ra lổi.');
							wheel.disable();
							$("#game-message").html("Vui lòng thử lại sau ít phút.");
						}
					});
				}
			});
		}
		$("#game-message").html("Click vào vòng quay để săn tìm giải thưởng");
		loadWheel(wheel);
		if(t <= 0){$("#game-message").html("Bạn hết lượt quay, Vui lòng nạp thêm!");};
	});
});