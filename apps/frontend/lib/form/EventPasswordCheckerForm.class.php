<?php

class EventPasswordCheckerForm extends sfForm
{
  
  public function configure() 
  {
    $this->setWidget('password', new sfWidgetFormInputPassword());
    
    $this->setValidator('password', new sfValidatorString(array('max_length' => 255, 'required' => false)));
    
    $this->validatorSchema->addOption('allow_extra_fields', true);
    
    $this->widgetSchema->setNameFormat('password[%s]');
    
    $this->validatorSchema->setPostValidator(
      new sfValidatorCallback(array('callback' => array($this, 'checkPassword')))
    );
  }
  
  public function checkPassword($validator, $values)
  {
    $userPassword = $values['password'];
    
    if ($userPassword != $this->getOption('event_password')){  
      throw new sfValidatorError($validator, 'Désolé, le mot de passe n\'est pas valide.');
    }else{
      return $values;
    }
  }
}