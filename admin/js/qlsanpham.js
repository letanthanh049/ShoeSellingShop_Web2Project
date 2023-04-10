	
		/*Tạo event cho input ChooseFile - source ảnh sẽ tự động cập nhật vào thẻ img*/
		$('#fileToUpload').on('change', function() {
		const object = document.querySelector('#fileToUpload').value;
		const imgView = document.querySelector('#showImg');
		if (object == "") setTimeout(function() {imgView.setAttribute('src', 'images/default-picture.png')}, 30);
		else imgView.setAttribute('src', 'images/' + object.substring(object.indexOf('fakepath') + 9));
		})

		/*Tạo event cho button xóa ảnh*/
		$('#delImage').on('click', function() {
			$('#showImg').attr('src', 'images/default-picture.png');
			document.querySelector('#fileToUpload').value = "";
		})
		

		const object = document.getElementById('formSP');
			
			/*Thêm event onchange trên combobox thương hiệu*/
			$('#inpTrademark').change(function (){
				$('#lbName').val($('#inpTrademark option:selected').html());
			});
		//vì 2 cái event cho nút sửa và xóa trong table nằm trong function 
		//nên khi vừa mở trang phải gọi 2 hàm này để kích hoạt event
		$(document).ready(function() {
			addEventForButton_Fix(); addEventForButton_Del();
		});
		
		/*Tạo event cho nút thêm sản phẩm*/
		document.querySelector('#toggle-add').addEventListener('click', e => {
			$('#errorName').attr('style', 'display: none;');
			$('#errorSize').attr('style', 'display: none;');
			$('#errorPrice').attr('style', 'display: none;');
			$('#Status').attr('style', 'display: none;');
			object.style.display = "block";
			$('#confirmFix').attr('style', 'display: none; margin-top: -10%;');
			$('#confirmAdd').attr('style', 'display: block;');
			//Reset Fields data
			document.querySelector('#fileToUpload').value = "";
			$('#showImg').attr('src', 'images/default-picture.png');
			$('#inpType').val(1);
			$('#inpTrademark').val(1);
			$('#lbName').val($('#inpTrademark option:selected').html());
			$('#lbDescribe').val('');
			$('#lbSize').val('');
			$('#inpColor').val(1);
			$('#lbPrice').val('');
			$('#lbAmount').val('');
			$('#lbStatus').val(1);
			eventForConfirm_Add();
		});
		
		/*Tạo event cho nút xác nhận thêm sản phẩm*/
		/*Check xem các Field trong form có trống không nếu có ngăn submit và báo lỗi*/
		function eventForConfirm_Add() {
			$('#confirmAdd').on('click',function(e) {
				e.preventDefault();
				const Status = []; Status[0] = 1; Status[1] = 1; Status[2] = 1;
				const Label = ['#errorName', '#errorSize', '#errorPrice'];
				const check1 = document.querySelector('#lbName');
				const check2 = document.querySelector('#lbSize');
				const check3 = document.querySelector('#lbPrice');
				for (var i=0; i<3; i++) {
					$(Label[i]).attr('style', 'display: none;');
				}
				if (check1.value == "") {
					Status[0] = 0;
					$('#errorName').html('Vui lồng nhập tên sản phẩm');
				} 
				else if (check1.value != "") {
					const st = $('#inpTrademark option:selected').html();
					if (check1.value.substr(0, st.length) == st) Status[0] = 1;
					else {
						$('#errorName').html('Tên sản phẩm không hợp lệ');
						Status[0] = 0; 
					}
				} 
				if (check2.value == "") Status[1] = 0; else Status[1] = 1;
				if (check3.value == "") Status[2] = 0; else Status[2] = 1;
				for (let i=0; i<3; i++) {
					if (Status[i] == 0) $(Label[i]).attr('style', 'display: block; color: red;');
				}
				
				//Add sản phẩm bằng Ajax kèm reload lại table khi Add thành công
				if (Status[0] == 1 && Status[1] == 1 && Status[2] == 1) {
					$.ajax({
					url: "./class/ProductHandling.php",
					type: "POST",
					data: {
						add: '',
						showImg: 'images/' + $('#fileToUpload').val().substr($('#fileToUpload').val().indexOf('fakepath') + 9),
						lbName: $('#lbName').val(),
						inpType: $('#inpType').val(),
						inpTrademark: $('#inpTrademark').val(),
						lbDescribe: $('#lbDescribe').val(),
						lbSize: $('#lbSize').val(),
						inpColor: $('#inpColor').val(),
						lbPrice: $('#lbPrice').val(),
						lbAmount: function() {if ($('#lbAmount').val() == "") return 0; else return $('#lbAmount').val();}
					},
					success: function(data) {	
							if (data == 1) {
								swal({title: 'Thêm sản phẩm thành công!', icon: 'success'});
								//Reload lại khối div để tạo mới lại table sau khi tương tác với database
								$('#btnConfirm').load(location.href + " #btnConfirm");
								$('#listSP').load(location.href + " #listSP");
								$('#formSP').attr('style', 'display: none;');
								//Vì Reload lại table => chạy lại lệnh php trong trang intitTable.php => reload lại event
								//vì thế phải thêm lại event cho nút sửa và xóa trong table
								setTimeout(function() {
									addEventForButton_Fix();
									addEventForButton_Del();
								}, 1500);
							} else {	
								swal({title: 'Thêm sản phẩm thất bại!', text: data, icon: 'error'});
							}
					},
					});
				}
			});
		}
		/*Tạo event cho tất cả các nút sửa - sửa đổi name của nút xác nhận thành nút sửa SP*/
		function addEventForButton_Fix () {
			document.querySelectorAll('#toggle-fix').forEach((item) => {
				item.addEventListener('click', (e) => {
					$('#errorName').attr('style', 'display: none;');
					$('#errorSize').attr('style', 'display: none;');
					$('#errorPrice').attr('style', 'display: none;');
					$('#Status').attr('style', 'display: block;');
					$('#confirmAdd').attr('style', 'display: none; margin-top: -10%;');
					$('#confirmFix').attr('style', 'display: block;');
					object.style.display = 'block';
					getRowData(item.value);
					eventForConfirm_Fix(item.value);
				});
			});
		}
		

		/*Lấy dữ liệu trên 1 hàng truyền vào form bằng event onclick trên nút sửa*/
		function getRowData(id) {
			const row = $('#toggle-fix[value='+id+']').closest('tr');
			const image = row.find('td').eq(1).find('img').attr('src');
			const name = row.find('td').eq(2).text();
			const type = row.find('td').eq(3).text();
			const trademark = row.find('td').eq(4).text();
			const size = row.find('td').eq(5).text();
			const color = row.find('td').eq(6).text();
			const price = row.find('td').eq(7).text();
			const amount = row.find('td').eq(8).text();
			const describe = row.find('td').eq(9).text();
			const status = row.find('td').eq(10).text();
			$('#showImg').attr('src', image);
			$('#lbName').val(name);
			for (let i=1; i<=$('#inpType option').length; i++)
				if ($('#inpType option[value='+i+']').text() == type) {
					$('#inpType').val(i);
					break;
				}
			for (let i=1; i<=$('#inpTrademark option').length; i++)
				if ($('#inpTrademark option[value='+i+']').text() == trademark) {
					$('#inpTrademark').val(i);
					break;
				}
				$('#lbSize').val(size);
			for (let i=1; i<=$('#inpColor option').length; i++)
				if ($('#inpColor option[value='+i+']').text() == color) {
					$('#inpColor').val(i);
					break;
				}
			$('#lbPrice').val(price);
			$('#lbAmount').val(amount);
			$('#lbDescribe').val(describe);
			if (status == "Còn hàng") $('#inpStatus').val(1);
			else if (status == "Hết hàng") $('#inpStatus').val(2);
		}
			

			/*Tạo event cho nút cập nhật ở Form sửa sản phẩm*/
			/*Check xem các Field trong form có trống không nếu có ngăn submit và báo lỗi*/
			function eventForConfirm_Fix(id) {
			$('#confirmFix').on('click', function(e) {
				e.preventDefault();
				const Status = []; Status[0] = 1; Status[1] = 1; Status[2] = 1; Status[3] = 1;
				const Label = ['#errorName', '#errorSize', '#errorPrice'];
				const check1 = document.querySelector('#lbName');
				const check2 = document.querySelector('#lbSize');
				const check3 = document.querySelector('#lbPrice');
				const check4 = $('table tbody').find('tr');
				let curRowNum = $('.btnGroup #toggle-fix[value='+id+']').closest('tr').find('td').eq(0).text();
				const trademark = $('#inpTrademark :selected').text().substr(0,2);
				const type = $('#inpType :selected').text().substr(0,1);
				for (var i=0; i<3; i++) {
					$(Label[i]).attr('style', 'display: none;');
				}
				if (check1.value == "") {
					Status[0] = 0;
					$('#errorName').html('Vui lồng nhập tên sản phẩm');
				} 
				else if (check1.value != "") {
					const subst = $('#inpTrademark option:selected').html();
					if (check1.value.substr(0, subst.length) == subst) Status[0] = 1;
					else {
						$('#errorName').html('Tên sản phẩm không hợp lệ');
						Status[0] = 0; 
					}
				} 
				if (check2.value == "") Status[1] = 0; else Status[1] = 1;
				if (check3.value == "") Status[2] = 0; else Status[2] = 1;
				for (let i=0; i<3; i++) {
					if (Status[i] == 0) $(Label[i]).attr('style', 'display: block; color: red;');
				}
				for (let i=0; i<$('table tbody tr').length; i++) {
					if (check4.eq(i).find('td').eq(0).text() != curRowNum) {
						if (Status[0] == 0 || Status[1] == 0) break;
						let idSP = trademark + type + check1.value + check2.value + $('#inpColor').val();
						if (check4.eq(i).find('td').eq(1).text() == idSP) {
							Status[3] = 0;
							break;
						}
					}
				}
				if (Status[3] == 0) {
					swal({title: 'Sửa dữ liệu thất bại', text: 'Dữ liệu được sửa bị trùng khớp với sản phẩm có sẵn', icon: 'error'});
					$('#formSP').attr('style', 'display: none;');
				}
				//Update dữ liệu sản phẩm bằng Ajax
				if (Status[0] == 1 && Status[1] == 1 && Status[2] == 1 && Status[3] == 1) {
					$.ajax({
					url: "./class/ProductHandling.php",
					type: "POST",
					data: {
						fix: '',
						idSP: id,
						showImg: $('#showImg').attr('src'),
						lbName: $('#lbName').val(),
						inpType: $('#inpType').val(),
						inpTrademark: $('#inpTrademark').val(),
						lbDescribe: $('#lbDescribe').val(),
						lbSize: $('#lbSize').val(),
						inpColor: $('#inpColor').val(),
						lbPrice: $('#lbPrice').val(),
						lbAmount: function() {if ($('#lbAmount').val() == "") return 0; else return $('#lbAmount').val();},
						inpStatus: $('#inpStatus').val()
					},
					success: function(data) {	
							if (data == 1) {
								swal({title: 'Sửa dữ liệu thành công!', icon: 'success'});
								//Reload lại khối div để tạo mới lại table sau khi tương tác với database
								$('#btnConfirm').load(location.href + " #btnConfirm");
								$('#listSP').load(location.href + " #listSP");
								$('#formSP').attr('style', 'display: none;');
								//Vì Reload lại table => chạy lại lệnh php trong trang intitTable.php => reload lại event
								//vì thế phải thêm lại event cho nút sửa và xóa trong table
								setTimeout(function() {
									addEventForButton_Fix();
									addEventForButton_Del();
								}, 1500);
							} else if (data == 2) {
								swal({title: 'Sửa dữ liệu thất bại!', text: 'Dữ liệu được sửa bị trùng khớp với sản phẩm có sẵn', icon: 'error'});
							} else {	
								swal({title: 'Sửa dữ liệu thất bại!', text: data, icon: 'error'});
							}
						},
					})
				}
			});}

			function  addEventForButton_Del() {
			document.querySelectorAll('#toggle-del').forEach(item => {
				item.addEventListener('click', e => {
					e.preventDefault();
					swal({
					  title: "Xác nhận xóa sản phẩm này?",
					  text: "Một khi sản phẩm bị xóa sẽ không khôi phục lại được!",
					  icon: "warning",
					  buttons: true,
					  dangerMode: true
					})
					.then((willDelete) => {
					  if (willDelete) {
						$.ajax({
						url: "./class/ProductHandling.php",
						type: "POST",
						data: {
							del: '',
							idSP: item.value,
						},
						success: function(data) {	
								if (data == 1) {
									swal({title: 'Xóa sản phẩm thành công!', icon: 'success'});
									//Reload lại khối div để tạo mới lại table sau khi tương tác với database
									$('#btnConfirm').load(location.href + " #btnConfirm")
									$('#listSP').load(location.href + " #listSP");
									$('#formSP').attr('style', 'display: none;');
									//Vì Reload lại table => chạy lại lệnh php trong trang intitTable.php => reload lại event
									//vì thế phải thêm lại event cho nút sửa và xóa trong table
									setTimeout(function() {
										addEventForButton_Fix();
										addEventForButton_Del();
									}, 1500);
								} else {	
									swal({title: 'Xóa sản phẩm thất bại!', text: data, icon: 'error'});
								}
						}
						})
					  } else {swal("Thao tác đã bị hủy!");}
					});
				});
			});
			}
		
			