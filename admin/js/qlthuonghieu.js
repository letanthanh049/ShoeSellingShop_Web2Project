		/*Lấy dữ liệu trên 1 hàng truyền vào form bằng event onclick trên nút chọn*/
		function getRowData() {
			$('#tableTH').on('click', '#btn-select', function() {
				const row = $(this).closest('tr');
				const id = row.find('td').eq(0).text();
				const name = row.find('td').eq(1).text();
				const status = row.find('td').eq(2).text();
				$('#lbName').val(name);
				if (status == 'Hoạt động') $('#inpStatus').val(1);
				else if (status == 'Vô hiệu hóa') $('#inpStatus').val(2);
				$('#delTH-btn').attr('value', id);
			})
		}
		
			/*Tạo event cho nút thêm ở Bảng chỉnh sửa*/
			/*Check xem Field Tenthuonghieu có trống không nếu có ngăn submit và báo lỗi*/
			$('.btnConfirm').on('click', function(e) {
				const check = document.querySelector('#lbName');
				if (check.value == '') {
					const error = document.querySelector('#errorName');
					error.setAttribute('style', 'color: red; display: block;');
					e.preventDefault();
				} 
			})


			/*Tạo event cho tất cả các nút chọn*/
			document.querySelectorAll('.btnGroup #btn-select').forEach(item => {
				item.addEventListener('click', event => {
					getRowData();
				})
			})

			

			