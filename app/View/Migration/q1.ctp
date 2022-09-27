<div class="row-fluid">
	<hr />

	<div class="alert">
		<h3>Migration Form</h3>
	</div>
<?php
echo $this->Form->create(false, ['type' => 'file','url' => ['controller'=>'Migration','action' => 'import']]);
echo $this->Form->input('file', array('label' => 'File Upload', 'type' => 'file'));
echo $this->Form->submit('Upload', array('class' => 'btn btn-primary'));
echo $this->Form->end();
?>

	<hr />

