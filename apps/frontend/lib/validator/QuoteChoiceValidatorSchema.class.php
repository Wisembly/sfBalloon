<?php

class QuoteChoiceValidatorSchema  extends sfValidatorSchema
{
  protected function configure($options = array(), $messages = array())
  {
    $this->addMessage('choice_value', 'The choice is required.');
  }
  
  protected function doClean($values)
  {
    $errorSchema = new sfValidatorErrorSchema($this);

    foreach ($values as $k => $v) {
      if(!$v['choice_value']){
        unset($values[$k]);   
      }
    }
    
    if (count($values) < 2) {
      $errorSchema->addError(new sfValidatorError($this, 'You need at least two choices.'), 'quote');
    }
    
    if (count($errorSchema)) {
      throw new sfValidatorErrorSchema($this, $errorSchema);
    }
    
    return $values;
  }
}