<?php
/**
 * file: app/model/photo.php
 *
 * Photo Model
 */

class Photo extends AppModel {
    var $name = 'Photo';
    var $belongsTo =
        array(
        'Event' => array(
                'className' => 'Event'
                    ), 
        'Attendee' => array(
                'className' => 'Attendee'
                    )
            );
}

?>