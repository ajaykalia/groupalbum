<?php
// file: app/models/dvd.php
// DVD Model

class Dvd extends AppModel {
	var $name = 'Dvd';

	var $belongsTo = array(
		'Format' => array(
			'className'=>'Format'
		),
		'Type' => array(
			'className'=> 'Type'
		),
		'Location' => array(
			'className'=>'Location'
		)
	);

	var $hasAndBelongsToMany = array(
		'Genre'=>array(
			'className'=>'Genre'
		)
	);

}

?>
