<?php

// file: /app/views/formats/admin_edit.ctp

?>

<div class="formats form">
<?php echo $form->create('Format');?>
	<fieldset>
		<legend>Edit Format</legend>
		<?php
		echo $form->input('id', array('type'=>'hidden'));		
		echo $form->input('name', array('label' => 'Name:'));
		echo $form->input('description', array('label'=>'Description:', 'type'=>'textarea'));
		?>
	</fieldset>
<?php echo $form->end('Edit');?>

</div>

<?php if(!empty($this->data['Dvd'])):  ?>

<div class = "related">
	<h3>DVDs with this Format</h3>
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($this->data['Dvd'] as $dvd): ?>
			<tr>
				<td><?php echo $dvd['id']; ?></td>
				<td><?php echo $dvd['name']; ?></td>
				<td><?php echo $html->link('Edit', '/admin/dvds/edit/'.$dvd['id']); ?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

<?php endif; ?>

<ul class="actions">
	<li><?php echo $html->link('List Formats', array('action'=>'index'));?></li>
</ul>



