<?php

class SimpleAnswerForm extends AnswerForm
{
  
  public function configure() 
  {
    $this->useFields(array('quote_id', 'answer'));
    
    $this->setWidgets(array(
      'quote_id' => new sfWidgetFormInputHidden(),
      'answer'   => new sfWidgetFormTextarea()
    ));
    
    $this->setValidators(array(
      'quote_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Quote'), 'required' => false)),
      'answer'       => new sfValidatorString(array('max_length' => 255)),
    ));
    
    $this->widgetSchema->setNameFormat('answer[%s]');
  }
  
}