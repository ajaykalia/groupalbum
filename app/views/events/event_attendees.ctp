<?php
/**
 * file: app/views/events/event_attendees.ctp
 *
 * Events Gallery Attendees (page loads in gallery.ctp)
 */
//echo('<pre>');
//print_r($event);
//print_r($this->data);
//echo('</pre>');

?>

<p>Contributors:&nbsp;
	<?php foreach($attendees as $attendee) : ?>
			<a href='http://facebook.com/profile.php?id=<?php echo($attendee['Attendee']['external_id']) ?>' target='#'><?php echo($attendee['Attendee']['name']) ?></a>				
	<?php endforeach ?>
</p>