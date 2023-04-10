		const object = document.getElementById('formNV');
		const btnAdd = document.getElementById('toggle-add');
		const btnConfirm = document.getElementById('btnConfirm');
		/*Tạo event cho nút thêm - sửa đổi name của nút xác nhận thành nút thêm NV*/
		btnAdd.onclick = function () {
			$('#Date').attr('style', 'display: none;');
			$('#Status').attr('style', 'display: none;');
			object.style.display = "block";
			btnConfirm.setAttribute('name', 'addNV-btn');
			//Reset Fields data
			$('#lbName').val('');
			$('#lbEmail').val('');
			$('#lbNum').val('');
			$('#lbSalary').val('');
			btnConfirm.value = -1;
			document.querySelector('#errorEmail').setAttribute('style', 'display: none;');
			document.querySelector('#errorName').setAttribute('style', 'display: none;');
		};
		
		

		/*Lấy dữ liệu trên 1 hàng truyền vào form bằng event onclick trên nút sửa*/
		function getRowData() {
			$('#tableNV').on('click', '.toggle-fix', function() {
				const row = $(this).closest('tr');
				const name = row.find('td').eq(1).text();
				const email = row.find('td').eq(2).text();
				const phoneNum = row.find('td').eq(3).text();
				const date = row.find('td').eq(4).text();
				const salary = row.find('td').eq(5).text();
				const status = row.find('td').eq(6).text();
				$('#lbName').val(name);
				$('#lbEmail').val(email);
				$('#lbNum').val(phoneNum);
				$('#inpDate').val(date);
				$('#lbSalary').val(salary);
				if (status == 'Còn làm việc') $('#inpStatus').val(1);
				else if (status == 'Đã nghỉ làm') $('#inpStatus').val(2);
			})
		}
		
		//Check xem dữ liệu trên form có bị trùng lặp với các nhân viên khác không
		//Nếu có ngăn không cho submit
		function Duplicate(check1, check2, position) {
			const pos = $('.toggle-fix[value='+position+']').closest('tr').index();
			let check = 1;
			for (let i=0; i<$('#tableNV tr').length-1; i++) {
				if (pos != i) {
					let columnName = $('#tableNV tbody').find('tr').eq(i).find('td').eq(1).html();
					let columnEmail = $('#tableNV tbody').find('tr').eq(i).find('td').eq(2).html();
					if (check1.value == columnName) check = 2;
					if (check2.value == columnEmail) check = 3;
				}
			}
			return check;
		}

			/*Tạo event cho nút xác nhận ở Form thêm nhân viên*/
			/*Check xem 2 Field Hoten và Email có trống không nếu có ngăn submit và báo lỗi*/
			btnConfirm.onclick = function(e) {
				const check1 = document.querySelector('#lbName');
				const check2 = document.querySelector('#lbEmail');
				const check3 = Duplicate(check1, check2, btnConfirm.value);
				if (check1.value == '') {
					const error1 = document.querySelector('#errorName');
					error1.setAttribute('style', 'color: red; display: block;');
					e.preventDefault();
				} else {document.querySelector('#errorName').setAttribute('style', 'color: red; display: none;');}
				if (check2.value == '') {
					const error2 = document.querySelector('#errorEmail');
					error2.setAttribute('style', 'color: red; display: block;');
					e.preventDefault();
				} else {document.querySelector('#errorEmail').setAttribute('style', 'color: red; display: none;');}
				if (check3 == 2) {
					swal('Lỗi dữ liệu', 'Nhân viên đã tồn tại', 'error');
					e.preventDefault();
				}
				if (check3 == 3) {
					swal('Lỗi dữ liệu', 'Email này đã được sử dụng', 'error');
					e.preventDefault();
				}
			}

			/*Tạo event cho tất cả các nút sửa - sửa đổi name của nút xác nhận thành nút sửa NV*/
			/*Đẩy tất cả dữ liệu từ 1 dòng vào form sửa*/
			document.querySelectorAll('.btnGroup .toggle-fix').forEach(item => {
				item.addEventListener('click', event => {
					$('#Date').attr('style', 'display: block;');
					$('#Status').attr('style', 'display: block;');
					getRowData();
					object.style.display = 'block';
					btnConfirm.setAttribute('name', 'fixNV-btn');
					btnConfirm.setAttribute('value', item.getAttribute('value'));
					document.querySelector('#errorEmail').setAttribute('style', 'display: none;');
					document.querySelector('#errorName').setAttribute('style', 'display: none;');
				})
			})
		
			
			/*Tạo event cho tất cả các nút xóa - xác nhận nút xóa muốn xóa nhân viên hay không*/
			document.querySelectorAll('.btnGroup .toggle-del').forEach(item => {
				item.addEventListener('click', event => {
					if (confirm('Xác nhận xóa nhân viên này')) item.setAttribute('type', 'submit');
				})
			})


