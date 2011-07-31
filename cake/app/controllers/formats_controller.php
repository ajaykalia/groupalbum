<?php

// file: app/controllers/formats_controller.php
// Formats Controller


class FormatsController extends AppController {
	var $name = 'Formats';

	var $helpers = array('Html', 'Form');

	// index()
	// main index page for the formats page
	// url: /formats/index
	function index() {
		$this->Format->recursive = 0;
		$formats = $this->Format->findAllByStatus('1');
		$this->set('formats', $formats);
	}


	// view()
	// displays a single format and all related dvds
	// url: /formats/view/format_slug
	function view($slug = null) {
		if(!$slug) {
			$this->Session->setFlash('Invalid id for Format');
			$this->redirect(array('action'=>'index'));
		}

		$format = $this->Format->findBySlug($slug);

		if(!empty($format)) {
			$this->set('format', $format);
		} else {
			$this->Session->setFlash('Invalid id for Format');
			$this->redirect(array('action'=>'index'));
		}

	}


	// admin_index()
	// main index for admin users
	// url: /admin/formats/index
	function admin_index() {
		$this->Format->recursive = 0;
		$formats = $this->Format->findAllByStatus('1');
		$this->set('formats', $formats);
	}

	
	// admin_add()
	// allows an admin to add a format
	// url: /admin/formats/add
	function admin_add() {
		if(!empty($this->data)) {
			$this->Format->create();
			$this->data['Format']['slug'] = $this->slug($this->data['Format']['name']);

			if ($this->Format->save($this->data)) {
				$this->Session->setFlash('The Format has been saved');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('The Format could not be saved.');
			}
		}
	}

	// admin_edit()
	// allows an admin to edit a format
	// url: /admin/formats/edit/id
	function admin_edit($id = null) {
	
		if(!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Format');
			$this->redirect(array('action'=>'index'));
		}

		if(!empty($this->data)) {
			$this->data['Format']['slug'] = $this->slug($this->data['Format']['name']);
			
			if($this->Format->save($this->data)) {
				$this->Session->setFlash('The Format has been saved');
			} else {
				$this->Session->setFlash('The Format could not be saved');
			}
		
		}

		if(empty($this->data)) {
			$this->data = $this->Format->read(null, $id);
		}

	}

	// admin_delete
	// allows an admin to delete a format
	// url: /admin/formats/delete/id
	function admin_delete($id = null) {
		
		if(!$id) {
			$this->Session->setFlash('Invalid id for Format');
			$this->redirect(array('action'=>'index'));
		}

		$this->Format->id = $id;
			
		if($this->Format->saveField('status', 0)) {
			$this->Session->setFlash('The Format was deleted');
		} else {
			$this->Session->setFlash('The Format could not be deleted');
		}

		$this->redirect(array('action'=>'index'));
	}	



}

?>
