<?php

class RegisterWallForm extends WallForm
{
  
  public function configure() 
  {
    $this->useFields(array('name', 'real_start_date'));
    
    $this->widgetSchema->setNameFormat('wall[%s]');
    $this->validatorSchema->setPostValidator(
      new sfValidatorCallback(array('callback' => array($this, 'checkRealDate')))
   );
  }

  public function checkRealDate($validator, $values)
  {
    $date = new Datetime();
    if($values['real_start_date'] < $date->format('Y-m-d H:i:s')){
      throw new sfValidatorError($validator, 'The start date must be after today.');
    }
  }
}