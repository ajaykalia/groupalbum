<?php
// file: app/models/format.php
// Format Model

class Format extends AppModel {
	var $name = 'Format';


	var $hasMany = array(
		'Dvd'=>array(
			'className'=>'Dvd'
		)
	);

}

?>
