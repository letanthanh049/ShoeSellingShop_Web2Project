//var randomScalingFactor = function(){ return Math.round(Math.random()*1000)};

var dataField = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
var choice = 1, dtStart = 0, dtEnd = 0;
var date1, date2, month1, month2;
	
$(document).ready(function() {loadChart();});
	//Kiểm tra sự thay đổi trên combobox lựa chọn
	$('#inpChoice').on('change', function() {
		choice = $('#inpChoice').val();
		const text = $('#inpChoice option:selected').html();
		console.log(text);
		if (choice == 1) {
			$('#inpTrademark').attr('style', 'display: none;');
			$('#inpType').attr('style', 'display: none;');
		}
		if (choice == 2) {
			$('#inpTrademark').attr('style', 'height: 30px; display: inline;');
			$('#inpType').attr('style', 'display: none;');
		}
		if (choice == 3) {
			$('#inpTrademark').attr('style', 'display: none;');
			$('#inpType').attr('style', 'height: 30px; display: inline;');
		}
	})
	$('#lbStart').on('change', function() {dtStart = $('#lbStart').val(); })
	$('#lbEnd').on('change', function() {dtEnd = $('#lbEnd').val(); })

	$('#confirmButton').on('click', function() {
		let Status = 1; 
		if (dtStart > dtEnd) {
			const temp = dtStart;
			dtStart = dtEnd;
			dtEnd = temp;
		}
		if (dtStart != 0 && dtEnd == 0) Status = 0;
		if (dtStart == 0 && dtEnd != 0) Status = 0;
		if (Status == 1) {
			$.ajax({
				url: './class/barchartData.php',
				type: 'POST',
				data: {
					confirmButton: '',
					choice: choice,
					trademark: $('#inpTrademark').val(),
					type: $('#inpType').val(),
					start: dtStart,
					end: dtEnd
				},
				success: function(data) {
						if (data == 1) swal('Lỗi dữ liệu', 'warning');
						else { 
							if (dtStart == 0 && dtEnd == 0) {
								var result = $.parseJSON(data);
								for (let i=0; i<=11; i++) 
									dataField[i] = result[i];

								barChartData.datasets[0].data = dataField;
								loadChart();
							}
							if (dtStart != 0 && dtEnd != 0) {
								var result = $.parseJSON(data);
								for (let i=0; i<=11; i++) 
									dataField[i] = result[i];
								
								barChartData.datasets[0].data = dataField;
//								$('#chart').load(location.href + " #chart");
								$('bar-chart').remove();
								$('#chart').append('<canvas class="main-chart" id="bar-chart" height="200" width="600"></canvas>');
								setTimeout(function() {loadChart(); }, 300);
							}
						}
					}
			})
		} else if (Status == 0) swal({title: "Lỗi dữ liệu!", text: "Ngày bắt đầu hoặc ngày kết thúc không hợp lệ", icon:"warning"})
	})

	var barChartData = {
			labels : ["Tháng 1","Tháng 2","Tháng 3","Tháng 4","Tháng 5","Tháng 6","Tháng 7","Tháng 8","Tháng 9","Tháng 10","Tháng 11","Tháng 12"],
			datasets : [
				{
					fillColor : "rgba(48, 164, 255, 0.2)",
					strokeColor : "rgba(48, 164, 255, 0.8)",
					highlightFill : "rgba(48, 164, 255, 0.75)",
					highlightStroke : "rgba(48, 164, 255, 1)",
					data : dataField
				}
			]
	
		}

function loadChart(){
	var chart2 = document.getElementById("bar-chart").getContext("2d");
	window.myBar = new Chart(chart2).Bar(barChartData, {
		responsive : true
	});
	
}
