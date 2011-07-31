<?php
/**
 * file: app/views/attendees/add.ctp
 *
 * Attendees Add - only used for debugging purposes
 */

echo('<pre>');
print_r($this->data); 
echo('</pre>');
?>

<?php 
/*


		<?php echo $form->create('Attendee', array('action'=>'add'));?>

		<fieldset>
		
			<legend>Add yourself as an attendee to <?php echo $this->data['Attendee']['event_name'] ?></legend>
			<?php
			echo $form->input('name', array('label'=>'name'));
			echo $form->input('event_id', array('label'=>'event_id',        'type'=>'hidden', 'value'=>$this->data['Attendee']['event_id']));

			// for the controller redirect
			echo $form->input('event_slug', array('label'=>'event_slug', 'type'=>'hidden', 'value'=>$this->data['Attendee']['event_slug'])); ?>

		</fieldset>
		<?php echo $form->end('Add');?>
		

	</div>
*/ ?>