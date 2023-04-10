		const object = document.getElementById('formCTKM');
		const btnAdd = document.getElementById('toggle-add');
		const btnConfirm = document.getElementById('btnConfirm');
		/*Tạo event cho nút thêm - sửa đổi name của nút xác nhận thành nút thêm TK*/
		btnAdd.onclick = function () {
			object.style.display = "block";
			btnConfirm.setAttribute('name', 'addCTKM-btn');
			$('#Status').attr('style', 'display: block;');
			$('#lbName').val('');
			$('#lbDiscount').val('');
			$('#lbDetail').val('');
			$('#inpDate').val('');
		};

		/*Lấy dữ liệu trên 1 hàng truyền vào form bằng event onclick trên nút sửa*/
		function getRowData() {
			$('#tableCTKM').on('click', '.toggle-fix', function() {
				const row = $(this).closest('tr');
				const name = row.find('td').eq(1).text();
				const discount = row.find('td').eq(2).text();
				const detail = row.find('td').eq(3).text();
				const date = row.find('td').eq(4).text();
				$('#lbName').val(name);
				$('#lbDiscount').val(discount);
				$('#lbDetail').val(detail);
				$('#inpDate').val(date);
			})
		}
		
			/*Tạo event cho nút xác nhận ở Form thêm tài khoản*/
			/*Check xem Field Taikhoan có trống không nếu có ngăn submit và báo lỗi*/
			btnConfirm.onclick = function(e) {
				const check1 = document.querySelector('#lbName');
				const check2 = document.querySelector('#lbDiscount');
				if (check1.value == '') {
					const error1 = document.querySelector('#errorName');
					error1.setAttribute('style', 'color: red; display: block;');
					e.preventDefault();
				} else {document.querySelector('#errorName').setAttribute('style', 'display: none;');}
				if (check2.value == '') {
					const error2 = document.querySelector('#errorDiscount');
					error2.setAttribute('style', 'color: red; display: block;');
					e.preventDefault();
				} else {document.querySelector('#errorDiscount').setAttribute('style', 'display: none;');}
			}


			/*Tạo event cho tất cả các nút sửa - sửa đổi name của nút xác nhận thành nút sửa TK*/
			document.querySelectorAll('.btnGroup .toggle-fix').forEach(item => {
				item.addEventListener('click', event => {
					object.style.display = 'block';
					getRowData();
					btnConfirm.setAttribute('name', 'fixCTKM-btn');
					btnConfirm.setAttribute('value', item.getAttribute('value'));
					$('#Status').attr('style', 'display: none;');
				})
			})

			/*Tạo event cho tất cả các nút vô hiệu hóa - xác nhận có muốn vô hiệu háo TK hay không*/
			document.querySelectorAll('.btnGroup .toggle-apply').forEach(item => {
				item.addEventListener('click', event => {
					item.setAttribute('type', 'submit');
				})
			})

			/*Tạo event cho tất cả các nút kích hoạt - xác nhận kích hoạt TK hay không*/
			document.querySelectorAll('.btnGroup .toggle-remove').forEach(item => {
				item.addEventListener('click', event => {
					item.setAttribute('type', 'submit');
				})
			})