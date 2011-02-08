<?php

class SimpleInvitationForm extends InvitationForm
{
  
  public function configure() 
  {
    parent::configure();
    $this->useFields(array('email', 'group_id', "event_id"));
    
    $this->setWidget('event_id', new sfWidgetFormInputHidden());
    
    $this->widgetSchema->setNameFormat('invitation[%s]');
  }
  
}