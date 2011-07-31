<?php
/**
 * file: app/controllers/attendees_controller.php
 *
 * Attendees Controller
 */
 
 class AttendeesController extends AppController {
     var $name = 'Attendees';
     
     var $helpers = array('Html','Form');
     
     /**
     index()
     main index page for attendees
     url: /attendees/index
     **/
     
     function index () {        
        // get all attendees from database
        $attendees = $this->Attendee->find('all');
        // save the attendees in a variable for the view
        $this->set('attendees', $attendees); 
		$this->layout=null;
     }
     
     /**
     view()
     view a single attendee and all related events / photos
     url: /attendees/view/attendee_id
     **/    
 
    function view($id=null) {
        if(!$id) {
            $this->Session->setFlash('Invalid id for Attendee(1)');
            $this->redirect(array('action'=>'index'));
        }
        
        $id = $this->Attendee->findById($id);
        
        if(!empty($id)) {
            $this->set('id', $id);
        } else {
            $this->Session->setFlash('Invalid id for Attendee(2)');
            $this->redirect(array('action'=>'index'));
        }
        
    }

    /**
    add()
    add an attendee to an event
    url: /attendees/add/
    **/    
    function add() {

		if(!empty($this->data['Attendee']['external_id'])) {

			$data_to_pass = array();
			
			$attendee_id_if_exists = $this->Attendee->findByExternalId($this->data['Attendee']['external_id']);
			
			if(empty($attendee_id_if_exists)) {

				$this->Attendee->create();

				if ($this->Attendee->save($this->data)) {
					$data_to_pass['Photo']['attendee_id'] = $this->Attendee->getLastInsertID(); 
				}
			} else {
					$data_to_pass['Photo']['attendee_id'] = $attendee_id_if_exists['Attendee']['id'];
			}
					

				$data_to_pass['Photo']['event_id'] = $this->data['Attendee']['event_id'];
				$data_to_pass['Photo']['event_slug'] = $this->data['Attendee']['event_slug'];
				$data_to_pass['Photo']['external_album_id'] = $this->data['Attendee']['external_album_id'];
				$data_to_pass['Photo']['fb_session_token'] = $this->data['Attendee']['fb_session_token'];					


				$this->autoRender = false; 
					$d = new Dispatcher(); 
					$d->dispatch( 
						array("controller" => "photos", "action" => "add"), 
						array("data" => $data_to_pass)
						); 

			
		
        }
    }

}
 
 ?>