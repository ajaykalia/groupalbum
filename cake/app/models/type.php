<?php
// file: app/models/type.php
// Type Model

class Type extends AppModel {
	var $name = 'Type';


	var $hasMany = array(
		'Dvd'=>array(
			'className'=>'Dvd'
		)
	);
	var $validate = array(
		'name' => array(
			'rule' 	=> 'notEmpty',
			'message' => 'Please enter a name'
		)
	);

}

?>
