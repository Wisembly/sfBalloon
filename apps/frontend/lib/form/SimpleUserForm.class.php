<?php

class SimpleUserForm extends sfGuardUserForm
{
  
  public function configure() 
  {
    parent::configure();
    $this->useFields(array('first_name', 'last_name', 'email_address', 'password'));
    
    $this->setWidget('password', new sfWidgetFormInputPassword(array(), array('autocomplete' => 'off')));
    $this->setValidator('password', new sfValidatorString(array('required' => false)));
    
    $this->widgetSchema->setHelp('password', 'Laissez vide si vous ne voulez pas changer de mot de passe');
    $this->widgetSchema->setNameFormat('user[%s]');
  }
  
  public function updatePasswordColumn($value)
	{
    if(!empty($value)){
      $value = md5($value);
    }else{
	    $value = $this->getObject()->getPassword();
    }
    
	  return $value;
	}
}