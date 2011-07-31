<?php
/**
 * file: app/views/photos/get_album.ctp
 *
 * Photos Get Album View
 */
echo('<pre>');
print_r($this->data);
echo('</pre>');
?>

<?php

	//IS THE USER LOGGED INTO FACEBOOK?
	require $_SERVER['DOCUMENT_ROOT'].'files/config.php';           
?>
	

    <?php if ($me): ?>

		<div>
		<?php 
			$event_id = $this->data['Photo']['event_id'];
			$event_slug = $this->data['Photo']['event_slug'];
			$attendee_id = $this->data['Photo']['attendee_id'];
		?>

		<?php
			// get user's album names for dropdowns
		    $album_names = array();
			
			foreach($albums["data"] as $album) {
				$album_id_key = $album['id'];
				$album_names[$album_id_key] = $album["name"];
			}

		?>


	<? // start the album dropdown ?>
		<form id="AlbumName" method="post" action="/photos/add">		
		<fieldset>
			<legend>Select an album</legend>
			<?php
		// which attendee and event owns the album
		echo $form->input('attendee_id', array('label'=>'attendee_id', 'type'=>'hidden', 'value'=>$attendee_id));
		echo $form->input('event_id', array('label'=>'event_id', 'type'=>'hidden', 'value'=>$event_id));

		// which album?
		echo $form->input('external_album_id', array( 'options'=>$album_names));
		
		// for the controller redirect
		echo $form->input('event_slug', array('label'=>'event_slug', 'type'=>'hidden', 'value'=>$event_slug)); 
		?>

		</fieldset>
		<?php echo $form->end('Select album');?>
		<p>
		You are currently logged into Facebook as <?php print_r($me['name']); ?>
		<p />&nbsp;<p />
		<a href='<?php echo $logoutUrl; ?>'><img src="http://static.ak.fbcdn.net/rsrc.php/z2Y31/hash/cxrz4k7j.gif"></a>
		<p />&nbsp;<p />		
		</div>
	
	<?php else: ?>
    	<div>
      		Start by connecting your Facebook account:
			<fb:login-button perms="publish_stream, user_photos"></fb:login-button>
    	</div>
  	<?php endif ?>
 