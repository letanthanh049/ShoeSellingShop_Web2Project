<div class="aside">
	<h3 class="aside-title">Giá</h3>
	<small>Chọn khoảng giá</small><br><br>
	<div class="price-filter">
							
	<div id="price-slider"></div>

	<div class="input-number price-min">
        <input id="price-min" type="number">
        <span class="qty-up">+</span>
        <span class="qty-down">-</span>
	</div>

	<span>-</span>
    
	<div class="input-number price-max">
		<input id="price-max" type="number">
		<span class="qty-up">+</span>
		<span class="qty-down">-</span>
	</div>
	<br/><br>
		<button class="btn" id="btn_gia">Áp Dụng</button>
	</div>
</div>
<style>
    /*-- Price Filter --*/

#price-slider {
	margin-bottom: 15px;
  }
  
  .price-filter .input-number {
	display: inline-block;
	width: calc(50% - 7px);
  }
  
.input-number {
  position: relative;
}

.input-number input[type="number"]::-webkit-inner-spin-button, .input-number input[type="number"]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

.input-number input[type="number"] {
  height: 40px;
  width: 100%;
  border: 1px solid #E4E7ED;
  background-color: #FFF;
  padding: 0px 35px 0px 15px;
}

.input-number .qty-up, .input-number .qty-down {
  position: absolute;
  display: block;
  width: 20px;
  height: 20px;
  border: 1px solid #E4E7ED;
  background-color: #FFF;
  text-align: center;
  font-weight: 700;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

.input-number .qty-up {
  right: 0;
  top: 0;
  border-bottom: 0px;
}

.input-number .qty-down {
  right: 0;
  bottom: 0;
}

.input-number .qty-up:hover, .input-number .qty-down:hover {
  background-color: #E4E7ED;
  color: #D10024;
}

</style>