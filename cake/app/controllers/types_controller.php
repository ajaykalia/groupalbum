<?php

// file: app/controllers/types_controller.php
// Types Controller


class TypesController extends AppController {
	var $name = 'Types';

	var $helpers = array('Html', 'Form');

	// index()
	// main index page for the types page
	// url: /types/index
	function index() {
		$this->Type->recursive = 0;
		$types = $this->Type->findAllByStatus('1');
		$this->set('types', $types);
	}


	// view()
	// displays a single type and all related dvds
	// url: /types/view/type_slug
	function view($slug = null) {
		if(!$slug) {
			$this->Session->setFlash('Invalid id for Type');
			$this->redirect(array('action'=>'index'));
		}

		$type = $this->Type->findBySlug($slug);

		if(!empty($type)) {
			$this->set('type', $type);
		} else {
			$this->Session->setFlash('Invalid id for Type');
			$this->redirect(array('action'=>'index'));
		}

	}


	// admin_index()
	// main index for admin users
	// url: /admin/types/index
	function admin_index() {
		$this->Type->recursive = 0;
		$types = $this->Type->findAllByStatus('1');
		$this->set('types', $types);
	}

	
	// admin_add()
	// allows an admin to add a type
	// url: /admin/types/add
	function admin_add() {
		if(!empty($this->data)) {
			$this->Type->create();
			$this->data['Type']['slug'] = $this->slug($this->data['Type']['name']);

			if ($this->Type->save($this->data)) {
				$this->Session->setFlash('The Type has been saved');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('The Type could not be saved.');
			}
		}
	}

	// admin_edit()
	// allows an admin to edit a type
	// url: /admin/types/edit/id
	function admin_edit($id = null) {
	
		if(!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Type');
			$this->redirect(array('action'=>'index'));
		}

		if(!empty($this->data)) {
			$this->data['Type']['slug'] = $this->slug($this->data['Type']['name']);
			
			if($this->Type->save($this->data)) {
				$this->Session->setFlash('The Type has been saved');
			} else {
				$this->Session->setFlash('The Type could not be saved');
			}
		
		}

		if(empty($this->data)) {
			$this->data = $this->Type->read(null, $id);
		}

	}

	// admin_delete
	// allows an admin to delete a type
	// url: /admin/types/delete/id
	function admin_delete($id = null) {
		
		if(!$id) {
			$this->Session->setFlash('Invalid id for Type');
			$this->redirect(array('action'=>'index'));
		}

		$this->Type->id = $id;
			
		if($this->Type->saveField('status', 0)) {
			$this->Session->setFlash('The Type was deleted');
		} else {
			$this->Session->setFlash('The Type could not be deleted');
		}

		$this->redirect(array('action'=>'index'));
	}	



}

?>
