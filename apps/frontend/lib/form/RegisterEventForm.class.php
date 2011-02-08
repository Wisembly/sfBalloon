<?php

class RegisterEventForm extends EventForm
{
  
  public function configure() 
  {
    $this->useFields(array('name', 'short'));
    
    $wallForm   = new RegisterWallForm();
		$this->embedForm('wall', $wallForm);
		
    $this->widgetSchema->setNameFormat('event[%s]');
  }
  
}