<script>
	function searchFocus(){
		if(document.sform.stext.value=='Search...'){
			document.sform.stext.value='';
		}
	}
	function searchBlur(){
		if(document.sform.stext.value==''){
			document.sform.stext.value='Search...';
		}
	}
</script>
<div id="search">
	<form class="navbar-form navbar-left" method="GET" name="sform" action="index.php">
		<div class="form-group">
			<input style="display: none;" name="pagetk" value="danhsachtimkiem">
			<input onfocus="searchFocus();" onblur="searchBlur();" type="text" class="form-control" value="Search..." name="stext" />
			<input style="display: none;" name="page" value="1">
		</div>
		<button type="submit" class="btn btn-default" style="background-color: #00bec4;"><img class="icon-search" src="image/magglass.png" style="width: 20px; height:20px;" />Tìm kiếm</button>
	</form>
</div>
