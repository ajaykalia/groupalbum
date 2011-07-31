<?php

// file: app/models/location.php
// Location Model

class Location extends AppModel {
	var $name = 'Location';


	var $hasMany = array(
		'Dvd'=>array(
			'className'=>'Dvd'
		)
	);

}

?>
