var choice = 1, dtStart = 0, dtEnd = 0;
	
	//Kiểm tra sự thay đổi trên combobox lựa chọn
	$('#inpChoice').on('change', function() {
		choice = $('#inpChoice').val();
		if (choice == 1) {
			$('#div1').attr('style', 'display: block;');
			$('#div2').attr('style', 'display: block;');
			$('#div4').attr('style', 'display: none;');
			$('#inpTrademark').attr('style', 'display: none;');
			$('#inpType').attr('style', 'display: none;');
		}
		if (choice == 2) {
			$('#div1').attr('style', 'display: block;');
			$('#div2').attr('style', 'display: block;');
			$('#div4').attr('style', 'display: none;');
			$('#inpTrademark').attr('style', 'height: 30px; display: inline;');
			$('#inpType').attr('style', 'display: none;');
		}
		if (choice == 3) {
			$('#div1').attr('style', 'display: block;');
			$('#div2').attr('style', 'display: block;');
			$('#div4').attr('style', 'display: none;');
			$('#inpTrademark').attr('style', 'display: none;');
			$('#inpType').attr('style', 'height: 30px; display: inline;');
		}
		if (choice == 4) {
			$('#div1').attr('style', 'display: none;');
			$('#div2').attr('style', 'display: none;');
			$('#inpTrademark').attr('style', 'display: none;');
			$('#inpType').attr('style', 'display: none;');
			$('#div4').attr('style', 'display: block;');
			$('#lbStart').val('');
			$('#lbEnd').val('');
		}
	})
	$('#lbStart').on('change', function() {dtStart = $('#lbStart').val(); })
	$('#lbEnd').on('change', function() {dtEnd = $('#lbEnd').val(); })

	$('#confirmButton').on('click', function() {
		let Status = 1; 
		let amount = $('#lbAmount').val();
		if (dtStart == "" && dtEnd == "") {dtStart = 0; dtEnd = 0;}
		if (dtStart > dtEnd) Status = 0;
		if (dtStart != 0 && dtEnd == 0) Status = 0;
		if (dtStart == 0 && dtEnd != 0) Status = 0;
		if (choice == 4) {
			if (!isNumeric(amount)) Status = -1;
			if (amount < 0) Status = -1;
		}
		if (Status == 1) {
			$('#tableContainer').attr('style', 'border: 2px groove rgba(120, 120, 120, 0.5); border-radius: 5px; display: block;');
			$.ajax({
				url: './class/barchartData.php',
				type: 'POST',
				data: {
					confirmButton: '',
					choice: choice,
					trademark: $('#inpTrademark').val(),
					type: $('#inpType').val(),
					start: dtStart,
					end: dtEnd,
					amount: amount
				},
				success: function(data) {
					var formatter = new Intl.NumberFormat('vi-VN', {
						style: "currency",
						currency: "VND"
					});
					var result = data.split(",");
					$('#total').html("Doanh thu: " + formatter.format(result[1]));
					$('#tableTK').html(result[0]);
					}
			})
		} else if (Status == 0) swal({title: "Lỗi dữ liệu!", text: "Khoảng thời gian không hợp lệ", icon:"warning"})
		  else if (Status == -1) swal({title: "Lỗi dữ liệu!", text: "Giá trị không hợp lệ", icon:"warning"})
	})


function isNumeric(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}
