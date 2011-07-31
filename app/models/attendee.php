<?php
/**
 * file: app/model/attendee.php
 *
 * Attendee Model
 */

class Attendee extends AppModel {
    var $name = 'Attendee';
    var $belongsTo = array(
        'Event' => array(
            'className' => 'Event'
            )
        );
        
    var $hasMany = array(
    'Photo' => array(
        'className' => 'Photo'
            )
        );

	function afterSave() {
		
	}
}

?>