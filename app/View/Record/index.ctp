
<div class="row-fluid">
	<table class="table table-bordered" id="table_records">
		<thead>
			<tr>
				<th>ID</th>
				<th>NAME</th>	
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<?php $this->start('script_own')?>
<script>
$(document).ready(function(){
	$("#table_records").dataTable({

		"bProcessing": true,
    	"bServerSide": true,
		"sAjaxSource": "/Dewtouch-interview/Record/display",
    	"aoColumns": [
			{mData:"Record.id"},
			{mData:"Record.name"}
    	]
	});
})
</script>
<?php $this->end()?>