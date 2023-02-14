/*global $,change*/
/*jslint plusplus: true */

$(function () {
	
	'use strict';
  var option = '',i;
		
		for (i = 1; i <= 14; i++) {
			option += '<option value="' + i + '">' + i + '</option>';
		}
		
		$('#ee').append(option);
});

function changeE(select) {
  
  'use strict';
  
  var option = '',
      $div = $('#aa'),
      n =  parseInt($(select).val()),
      i;
		
		for (i = 0; i < n; i++) 
		{
			option += '<br><hr><div class="control-group"><label class="control-label" id="lsize">Size</label><div class="controls"><div class="input-prepend"><input type="text" name="Size[]"  id="size"  maxlength=4 size=1 class="span2"><div class="input-prepend"><label class="control-label" id="lbarcode">Barcod . .  . </label><span class="add-on"><h4><i class="menu-icon icon-barcode"></i></h4></span><input type="text" name="Barcode[]"  id="barcode"  maxlength=14 class="span5"></div></div></div><div class="control-group"><label class="control-label" id="lnumber">Number</label></label><div class="controls"><div class="input-prepend"><input type="number" name="Number[]"  id="number"  maxlength=3  class="span4"></div></div></div></div>';

		}
  
    $div.empty();
	$div.append(option);
}