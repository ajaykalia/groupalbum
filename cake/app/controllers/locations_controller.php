<?php

// file: app/controllers/locations_controller.php
// Locations Controller


class LocationsController extends AppController {
	var $name = 'Locations';

	var $helpers = array('Html', 'Form');

	// index()
	// main index page for the locations page
	// url: /locations/index
	function index() {
		$this->Location->recursive = 0;
		$locations = $this->Location->findAllByStatus('1');
		$this->set('locations', $locations);
	}


	// view()
	// displays a single location and all related dvds
	// url: /locations/view/location_slug
	function view($slug = null) {
		if(!$slug) {
			$this->Session->setFlash('Invalid id for Location');
			$this->redirect(array('action'=>'index'));
		}

		$location = $this->Location->findBySlug($slug);

		if(!empty($location)) {
			$this->set('location', $location);
		} else {
			$this->Session->setFlash('Invalid id for Location');
			$this->redirect(array('action'=>'index'));
		}

	}


	// admin_index()
	// main index for admin users
	// url: /admin/locations/index
	function admin_index() {
		$this->Location->recursive = 0;
		$locations = $this->Location->findAllByStatus('1');
		$this->set('locations', $locations);
	}

	
	// admin_add()
	// allows an admin to add a location
	// url: /admin/locations/add
	function admin_add() {
		if(!empty($this->data)) {
			$this->Location->create();
			$this->data['Location']['slug'] = $this->slug($this->data['Location']['name']);

			if ($this->Location->save($this->data)) {
				$this->Session->setFlash('The Location has been saved');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('The Location could not be saved');
			}
		}
	}

	// admin_edit()
	// allows an admin to edit a location
	// url: /admin/locations/edit/id
	function admin_edit($id = null) {
	
		if(!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Location');
			$this->redirect(array('action'=>'index'));
		}

		if(!empty($this->data)) {
			$this->data['Location']['slug'] = $this->slug($this->data['Location']['name']);
			
			if($this->Location->save($this->data)) {
				$this->Session->setFlash('The Location has been saved');
			} else {
				$this->Session->setFlash('The Location could not be saved');
			}
		
		}

		if(empty($this->data)) {
			$this->data = $this->Location->read(null, $id);
		}

	}

	// admin_delete
	// allows an admin to delete a location
	// url: /admin/locations/delete/id
	function admin_delete($id = null) {
		
		if(!$id) {
			$this->Session->setFlash('Invalid id for Location');
			$this->redirect(array('action'=>'index'));
		}

		$this->Location->id = $id;
			
		if($this->Location->saveField('status', 0)) {
			$this->Session->setFlash('The Location was deleted');
		} else {
			$this->Session->setFlash('The Location could not be deleted');
		}

		$this->redirect(array('action'=>'index'));
	}	



}

?>
