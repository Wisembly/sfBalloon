<?php

class RegisterWallForm extends WallForm
{
  
  public function configure() 
  {
    $this->useFields(array('name', 'real_start_date'));
		
    $this->widgetSchema->setNameFormat('wall[%s]');
  }
  
}