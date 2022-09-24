<div class="alert  ">
<button class="close" data-dismiss="alert"></button>
Question: Advanced Input Field</div>

<p>
1. Make the Description, Quantity, Unit price field as text at first. When user clicks the text, it changes to input field for use to edit. Refer to the following video.

</p>


<p>
2. When user clicks the add button at left top of table, it wil auto insert a new row into the table with empty value. Pay attention to the input field name. For example the quantity field

<?php echo htmlentities('<input name="data[1][quantity]" class="">')?> ,  you have to change the data[1][quantity] to other name such as data[2][quantity] or data["any other not used number"][quantity]

</p>



<div class="alert alert-success">
<button class="close" data-dismiss="alert"></button>
The table you start with</div>

<table class="table table-striped table-bordered table-hover">
<thead>
<th><span id="add_item_button" class="btn mini green addbutton" onclick="addToObj=false">
											<i class="icon-plus"></i></span></th>
<th>Description</th>
<th>Quantity</th>
<th>Unit Price</th>
</thead>

<tbody>
	<tr class="hide template">
		<td></td>
		<td><textarea name="data[0][description]" class="textfields m-wrap description required hide" rows="2" type=""></textarea></td>
		<td><input name="data[0][quantity]" class="textfields hide"></td>
		<td><input name="data[0][unit_price]"  class="textfields hide"></td>
	</tr>
	<tr>
		<td></td>
		<td><textarea name="data[1][description]" class="textfields m-wrap description required hide" rows="2" type=""></textarea></td>
		<td><input name="data[1][quantity]" class="textfields hide"></td>
		<td><input name="data[1][unit_price]"  class="textfields hide"></td>
	</tr>

</tbody>

</table>


<p></p>
<div class="alert alert-info ">
<button class="close" data-dismiss="alert"></button>
Video Instruction</div>

<p style="text-align:left;">
<video width="78%"   controls>
  <source src="<?php echo Router::url("/video/q3_2.mov") ?>">
Your browser does not support the video tag.
</video>
</p>


<style>
	table td {
		height:25px;
	}
	.hide{
		display:none;
	}
</style>>


<?php $this->start('script_own');?>
<script>
$(document).ready(function(){
	$('table td').live('click', function(){
		var oSelectedCell = $(this);
		oSelectedCell.children().removeClass('hide').focus();
		oSelectedCell.find('p').remove();

	});

	$('.textfields').live('focusout',function(){
		$(this).addClass('hide')
		var sTextValue = $(this).val();
		$(this).parent().append('<p>' + sTextValue + '</p>');
		
	});


	$("#add_item_button").click(function(){

		var oCopyTemplate = $('.template').clone();
		oCopyTemplate.removeClass('hide template');
		$('table tbody').prepend(oCopyTemplate);

	});

	
});
</script>
<?php $this->end();?>

