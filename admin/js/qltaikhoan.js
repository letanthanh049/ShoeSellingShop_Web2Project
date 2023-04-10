		const object = document.getElementById('formTK');
		const btnAdd = document.getElementById('toggle-add');
		const btnConfirm = document.getElementById('btnConfirm');
		/*Tạo event cho nút thêm - sửa đổi name của nút xác nhận thành nút thêm TK*/
		btnAdd.onclick = function () {
			object.style.display = "block";
			btnConfirm.setAttribute('name', 'addTK-btn');
			//Reset Fields data
			$('#Status').attr('style', 'display: block;');
			$('#lbUsername').val('');
			$('#lbPassword').val('');
			$('#inpDate').val('');
			$('#inpRole').val(3);
			btnConfirm.value = -1;
			document.querySelector('#errorUsername').setAttribute('style', 'display: none;');
		};

		/*Lấy dữ liệu trên 1 hàng truyền vào form bằng event onclick trên nút sửa*/
		function getRowData() {
			$('#tableTK').on('click', '.toggle-fix', function() {
				const row = $(this).closest('tr');
				const username = row.find('td').eq(1).text();
				const password = row.find('td').eq(2).text();
				const date = row.find('td').eq(3).text();
				const role = row.find('td').eq(4).text();
				const status = row.find('td').eq(5).text();
				$('#lbUsername').val(username);
				$('#lbPassword').val(password);
				$('#inpDate').val(date);
				if (role == 'Admin') $('#inpRole').val(1);
				else if (role == 'Khách hàng') $('#inpRole').val(2);
				else if (role == 'Nhân viên') $('#inpRole').val(3);
				if (status == 'Hoạt động') $('#inpStatus').val(1);
				else if (status == 'Bị vô hiệu') $('#inpStatus').val(2);
			})
		}

		//Check xem dữ liệu trên form có bị trùng lặp với các nhân viên khác không
		//Nếu có ngăn không cho submit
		function Duplicate(check1, check2, position) {
			const pos = $('.toggle-fix[value='+position+']').closest('tr').index();
			let check = 1;
			for (let i=0; i<$('#tableTK tr').length-1; i++) {
				if (pos != i) {
					let columnName = $('#tableTK tbody').find('tr').eq(i).find('td').eq(1).html();
					if (check1.value == columnName) check = 2;
				}
			}
			return check;
		}
		
			/*Tạo event cho nút xác nhận ở Form thêm tài khoản*/
			/*Check xem Field Taikhoan có trống không nếu có ngăn submit và báo lỗi*/
			btnConfirm.onclick = function(e) {
				const check1 = document.querySelector('#lbUsername');
				const check2 = document.querySelector('#lbPassword');
				const check3 = Duplicate(check1, check2, btnConfirm.value);
				if (check1.value == '') {
					const error1 = document.querySelector('#errorUsername');
					error1.setAttribute('style', 'color: red; display: block;');
					e.preventDefault();
				} else {document.querySelector('#errorUsername').setAttribute('style', 'display: none;');}
				if (check2.value == '') {
					const error2 = document.querySelector('#errorPassword');
					error2.setAttribute('style', 'color: red; display: block;');
					e.preventDefault();
				} else {document.querySelector('#errorPassword').setAttribute('style', 'display: none;');}
				if (check3 == 2) {
					swal('Lỗi dữ liệu', 'Tài khoản đã tồn tại', 'error');
					e.preventDefault();
				}
			}


			/*Tạo event cho tất cả các nút sửa - sửa đổi name của nút xác nhận thành nút sửa TK*/
			document.querySelectorAll('.btnGroup .toggle-fix').forEach(item => {
				item.addEventListener('click', event => {
					object.style.display = 'block';
					getRowData();
					btnConfirm.setAttribute('name', 'fixTK-btn');
					btnConfirm.setAttribute('value', item.getAttribute('value'));
					$('#Status').attr('style', 'display: none;');
					document.querySelector('#errorUsername').setAttribute('style', 'display: none;');
				})
			})
