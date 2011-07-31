<?php
/**
 * file: app/controllers/photos_controller.php
 *
 * Photos Controller
 */
 
 class PhotosController extends AppController {
     var $name = 'Photos';
     
     var $helpers = array('Html','Form');
	 var $components = array('RequestHandler');
 	 var $uses = array('Photo', 'Attendee');
	
     
     /**
     index()
     main index page for photos
     url: /photos/index
     **/
     
     function index () {        
        // get all attendees from database
        $photos = $this->Photo->find('all');
        // save the attendees in a variable for the view
        $this->set('photos', $photos); 

     }

     function photo_gallery () {        

		
		// get all photos from event
		$event_id = $this->params['url']['event_id'];
		$find_conditions = array('conditions' => array('Photo.event_id' => $event_id), 'order'=>'Photo.created DESC');
		$photos = $this->Photo->find('all', $find_conditions);

        // save the attendees in a variable for the view
		
		$this->set('photos', $photos);
		
		// get facebook login URL if user is not logged in		
		require $_SERVER['DOCUMENT_ROOT'].'files/config.php';
		
		$session = $facebook->getSession();
		
		if($session) {
			$me = $facebook->api('me');
			$friend_list = $facebook->api('me/friends');
			
			$this->set('me', $me);
			$this->set('friend_list', $friend_list);
		} else {
			$loginUrl = $facebook->getLoginUrl();
			$this->set('loginUrl', $loginUrl);	
		}


		
		 

     }

	

     
     /**
     view()
     view a single photo and all related events / attendees
     url: /photos/view/photo_id
     **/    
 
    function view($id=null) {
        if(!$id) {
            $this->Session->setFlash('Invalid id for Photo(1)');
            $this->redirect(array('action'=>'index'));
        }
        
        $id = $this->Photo->findById($id);
        
        if(!empty($id)) {
            $this->set('id', $id);
        } else {
            $this->Session->setFlash('Invalid id for Photo(2)');
            $this->redirect(array('action'=>'index'));
        }
        
    }

    /**
    get_album()
    log into Facebook to pull up a list of albums
    url: /photo/get_album/
    **/
	function get_album() {
		
		
	}


    /**
    add()
    add a set of photos to the database
    url: /photo/add/
    **/   
    function add() {
        // if user has just passed in album to add

		if(!empty($this->data['Photo']['user_added_photos'])) {
           
 			// curl photos from album
			$fb_album_id = $this->data["Photo"]["external_album_id"];
			$fb_session_token = $this->data["Photo"]['fb_session_token'];

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

			foreach($photos["data"] as $photo) {
				$photo_to_save['attendee_id'] = $this->data['Photo']['attendee_id'];
				$photo_to_save['event_id'] = $this->data['Photo']['event_id'];
				$photo_to_save['source_url'] = $photo['source'];
				$photo_to_save['thumb_url'] = $photo['picture'];
				$photo_to_save['external_album_id'] = $this->data['Photo']['external_album_id'];
				$photo_to_save['external_photo_id'] = $photo['id'];
				$photo_to_save['external_photo_link'] = $photo['link'];
				$photo_to_save['privacy'] = $this->data['Photo']['privacy'];
				$photos_to_save["Photo"][]= $photo_to_save; 

			}
			

			
			$this->Photo->create();
            if ($this->Photo->saveAll($photos_to_save['Photo'])) {
               // $this->Session->setFlash('Thanks, your photos have been added');
               echo("The photos were saved");
                
               $this->redirect(array('controller' => 'events', 'action'=>'gallery',$this->data['Photo']['event_slug']));
            	} else {
                //$this->Session->setFlash('Please try again');
				echo("No dice.");
            }  
		} else {
			
		}
	}
	



    /**
    copy()
    user can mooch a photo to an event
    url: /photo/mooch/
    **/	

	/** 
	ajax_get_album_photos()
	An AJAX call to pull up album photos whenever a set is selected from the Gallery dropdown
	**/
	
	function ajax_get_album_photos () {
		//init
		$external_album_id = $this->params['form']['external_album_id'];
		$this->layout=null;
		
			// Get Facebook Photo URLs for album
			/*require 'facebook_sdk/src/facebook.php';*/

			// Create our Application instance (replace this with your appId and secret).
		if(!(isset($session))) {
		require_once $_SERVER['DOCUMENT_ROOT'].'files/facebook_sdk/src/facebook.php';
			$facebook = new Facebook(array(
			  'appId'  => '197989656904228',
			  'secret' => 'f54258a27f57c0062fa7368e2b696f31',
			  'cookie' => true,
			  'fileUpload' => true,
			)); }

			$session = $facebook->getSession();

			// curl photos from album
			$facebook_album_id = $external_album_id;

			$ch = curl_init();
				$my_album = 'https://graph.facebook.com/'.$facebook_album_id.'?access_token='.$session['access_token'];
				curl_setopt($ch, CURLOPT_URL, $my_album); 
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
				$album = curl_exec ($ch);
			curl_close ($ch);

			$album = json_decode($album, true);


			$ch = curl_init();
				$my_album_photos = 'https://graph.facebook.com/'.$facebook_album_id.'/photos?access_token='.$session['access_token'];
				curl_setopt($ch, CURLOPT_URL, $my_album_photos); 
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
				$photos = curl_exec ($ch);
			curl_close ($ch);

			$photos = json_decode($photos, true);
			// end curl

			// curl album link

			$this->set('external_album_id', $external_album_id);
			$this->set('photos', $photos);
			$this->set('album', $album);

		
		
		}
	

}
 
 ?>