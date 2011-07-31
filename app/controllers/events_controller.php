<?php
/**
 * file: app/controllers/events_controller.php
 *
 * Events Controller
 */
 
 class EventsController extends AppController {
     var $name = 'Events';
     var $helpers = array('Html','Form');
     var $users = array('Attendees', 'Events', 'Photos');
	
     /**
     index()
     main index page for events
     url: /events/index
     **/
     
     function index () {
        $this->Event->recursive = 0;
        
        // get all events from database
        $events = $this->Event->find('all');
        // save the events in a variable for the view
        $this->set('events', $events); 
     }
     
     /**
     view()
     view a single event and all related attendees / photos
     url: /events/view/event_slug
     **/    
 
    function view($slug = null) {
        if(!$slug) {
            $this->Session->setFlash('Invalid id for Event(noslug)');
            $this->redirect(array('action'=>'index'));
        }
        
        $event = $this->Event->findBySlug($slug);
        
        if(!empty($event)) {
            $this->set('event', $event);
        } else {
            $this->Session->setFlash('Invalid id for Event(noevent)');
            $this->redirect(array('action'=>'index'));
        }
    }
     
    function gallery($slug = null) {
		require $_SERVER['DOCUMENT_ROOT'].'files/config.php';
		
		$session = $facebook->getSession();
		$me = null;
		$albums = null;
		$loginUrl = null;
		$logoutUrl = null;
		
		if ($session) {
			try {
				$me = $facebook->api('me');
				$albums = $facebook->api('me/albums');
		  	} catch (FacebookApiException $e) {
		    	error_log($e);
		  	}
		}
		
		if ($me) {
		  $logoutUrl = $facebook->getLogoutUrl();
		} else {
		  $loginUrl = $facebook->getLoginUrl();
		}

		$this->set('session', $session);
		$this->set('me', $me);
		$this->set('albums', $albums);
		$this->set('loginUrl', $loginUrl);
		$this->set('logoutUrl', $logoutUrl);
		
		$this->Event->recursive = 2;	
		
		if(!$slug) {
            $this->Session->setFlash('Invalid id for Event(noslug)');
            $this->redirect(array('action'=>'index'));
        }

        $event = $this->Event->findBySlug($slug);
        
		if(!empty($event)) {
            $this->set('event', $event);
        } else {
            $this->Session->setFlash('Invalid id for Event(noevent)');
            $this->redirect(array('action'=>'index'));
        }  
        
    }

	/**
	ajax_add_album()
	An AJAX call to add selected photos and attendee to database
	**/
	
	function ajax_add_album () {
		
	//	 null layout for AJAX
		$this->layout = null;

		$data_to_save = array();
		
		$data_to_save['Attendee']['name'] = $this->data['Event']['attendee_name'];
		$data_to_save['Attendee']['event_id'] = $this->data['Event']['event_id'];
		$data_to_save['Attendee']['external_id'] = $this->data['Event']['external_user_id'];
		$data_to_save['Attendee']['external_token'] = $this->data['Event']['fb_session_token'];
		
		$this->Event->Attendee->recursive = -1;
        
        // get attendee from database if they already exists
        $attendee_exists = $this->Event->Attendee->findAllByExternalId($this->data['Event']['external_user_id']);

		if(empty($attendee_exists)) {
			if ($this->Event->Attendee->saveAll($data_to_save)) {
           		// $this->Session->setFlash('Thanks, your photos have been added');
           		echo("The attendee was saved");
            
        		} else {
            		//$this->Session->setFlash('Please try again');
					echo("Failed to save attendee.");
	
        		}
 		} else {
			echo("Attendee already exists");
		}
		
		
		// curl photos from album
		$fb_album_id = $this->data["Event"]["external_album_id"];
		$fb_session_token = $this->data["Event"]['fb_session_token'];

		$ch = curl_init();
			$my_album = 'https://graph.facebook.com/'.$fb_album_id.'/photos?access_token='.$fb_session_token;
			curl_setopt($ch, CURLOPT_URL, $my_album); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			$photos = curl_exec ($ch);
		curl_close ($ch);

		$photos = json_decode($photos, true);
		// end curl



		//grab source and thumb urls + photo facebook IDs

		$photos_to_save = array();
		$photo_to_save = array();

		 $attendee_id = $this->Event->Attendee->findByExternalId($this->data['Event']['external_user_id']);
		
		foreach($photos["data"] as $photo) {
			
			$this->Event->Photo->recursive = 0;
			
			$photo_exists = $this->Event->Photo->findByExternalPhotoId($photo['id']);
		//	echo("<pre>");
		//	print_r($photo);
		//	echo("<br>");
			if(empty($photo_exists)) {
			
				$photo_to_save['attendee_id'] = $attendee_id['Attendee']['id'];
				$photo_to_save['event_id'] = $this->data['Event']['event_id'];
				$photo_to_save['source_url'] = $photo['source'];
				$photo_to_save['thumb_url'] = $photo['picture'];
				$photo_to_save['external_album_id'] = $this->data['Event']['external_album_id'];
				$photo_to_save['external_photo_id'] = $photo['id'];
				$photo_to_save['external_photo_link'] = $photo['link'];
				$photo_to_save['privacy'] = $this->data['Event']['privacy'];
				$photos_to_save["Photo"][]= $photo_to_save; 

			} 
		}
		//echo("<pre>");
		//print_r($photos_to_save);
		//echo("</pre>");
		

		if(!empty($photos_to_save)) {
			$this->Event->Photo->create();
        	if ($this->Event->Photo->saveAll($photos_to_save['Photo'])) {
           		// $this->Session->setFlash('Thanks, your photos have been added');
           		echo("The photos were saved");   
        	} else {
            //$this->Session->setFlash('Please try again');
				echo("Couldnt save photos.");
        	}  
		} else {
			echo("no new photos");
		}
	}    
	
	function event_attendees () {
	//	 null layout for AJAX
		$this->layout = null;
		
		$this->Event->Attendee->recursive = -1;
   
		$event_id = $this->params['url']['event_id'];
		$attendees = $this->Event->Attendee->findAllByEventId($event_id);
		$this->set('attendees', $attendees);
	//	echo("<pre>");
	//	print_r($this->viewVars);
	//	echo("</pre>");
	}
	
	function overlay() {
		
	}
	
	function add_album_box () {
		$this->layout = null;
		$event_id = $this->params['url']['event_id'];
		$this->set('event_id', $event_id);
		
		
		require $_SERVER['DOCUMENT_ROOT'].'files/config.php';
		
		$session = $facebook->getSession();
		$me = null;
		$albums = null;
		$loginUrl = null;
		$logoutUrl = null;
		
		if ($session) {
			try {
				$me = $facebook->api('me');
				$albums = $facebook->api('me/albums');
				$logoutUrl = $facebook->getLogoutUrl();
				
				$this->set('logoutUrl', $logoutUrl);
		  	} catch (FacebookApiException $e) {
		    	error_log($e);
		  	}
		}


		$this->set('session', $session);
		$this->set('me', $me);
		$this->set('albums', $albums);

		
		
	}

}
 
 ?>