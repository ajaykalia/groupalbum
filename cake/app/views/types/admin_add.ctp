<?php

// file: /app/views/types/admin_add.ctp

?>

<div class="types form">
<?php echo $form->create('Type');?>
	<fieldset>
		<legend>Add a Type</legend>
		<?php
		echo $form->input('name', array('label' => 'Name:'));
		echo $form->input('description', array('label'=>'Description:', 'type'=>'textarea'));
		?>
	</fieldset>
<?php echo $form->end('Add');?>

</div>

<ul class="actions">
	<li><?php echo $html->link('List Types', array('action'=>'index'));?></li>
</ul>



