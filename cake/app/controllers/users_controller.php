<?php

class UsersController extends AppController
{



   function register () {
	
	if (!empty($this->params['form']))
	{
		if ($this->User->save($this->params['form']))
		{
			$this->flash('Your user registration information was accepted.', 'cake/users/register');
		} 
		else
		{
			$this->flash('There was a problem with your registration', 'cake/users/register');
		}
	}
		
   }

   
   function knownusers() {
	$this->set('knownusers',
		$this->User->findAll(null, array('id', 'username', 'first_name', 'last_name'),'id DESC')
	_;
   }
	


   }
		

}

?>
