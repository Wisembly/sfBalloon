<?php

class SimpleQuoteForm extends QuoteForm
{
  
  public function configure() 
  {
    $this->useFields(array('wall_id', 'quote'));
    
    $this->setWidgets(array(
      'wall_id' => new sfWidgetFormInputHidden(),
      'quote'   => new sfWidgetFormTextarea()
    ));
    
    $this->setValidators(array(
      'wall_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Wall'), 'required' => false)),
      'quote'        => new sfValidatorString(array('max_length' => 255)),
    ));
    
    $this->widgetSchema->setNameFormat('quote[%s]');
  }
  
}