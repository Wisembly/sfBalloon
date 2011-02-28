<?php

class AddWallForm extends BaseForm
{
  
  public function configure() 
  {

    $this->setWidgets(array(
      'offer'     => new sfWidgetFormDoctrineChoice(array('model' => 'Offer', 'add_empty' => false, 'expanded' => true))
    ));

    $this->setValidators(array(
      'offer' => new sfValidatorDoctrineChoice(array('model' => 'Offer', 'required' => true)),
    ));

    $wallForm   = new RegisterWallForm();
    $this->embedForm('wall', $wallForm);
    
    $this->widgetSchema->setNameFormat('new_wall[%s]');
  }
}