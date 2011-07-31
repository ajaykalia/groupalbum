<?php
/**
 * file: app/model/event.php
 *
 * Event Model
 */
 
class Event extends AppModel {
    var $name = 'Event';
    var $hasMany = array(
        'Attendee' => array(
            'className' => 'Attendee'
            ),
        'Photo' => array(
            'className' => 'Photo'
            )
        );
}

?>