<?php

class SimpleSurveyForm extends QuoteForm
{

  public static $durations = array(
    '1' => '1 minute',
    '2' => '2 minutes',
    '3' => '3 minutes',
    '4' => '4 minutes',
    '5' => '5 minutes',
    '10' => '10 minutes',
  );
  
  public function configure() 
  {
    $this->useFields(array('wall_id', 'quote'));
    
    $this->setWidgets(array(
      'wall_id'       => new sfWidgetFormInputHidden(),
      'quote'         => new sfWidgetFormTextarea(),
      'poll_duration' => new sfWidgetFormChoice(array('choices' => SimpleSurveyForm::$durations))
    ));
    
    $this->setValidators(array(
      'wall_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Wall'), 'required' => false)),
      'quote'        => new sfValidatorString(array('max_length' => 255)),
      'poll_duration'=> new sfValidatorChoice(array('choices' => array_keys(SimpleSurveyForm::$durations)))
    ));
    
    $form = new QuoteChoiceCollectionForm(null, array(
			'quote' => $this->getObject(),
      'size'    => 5,
    ));
		
	 	$this->embedForm('poll_choices', $form);
		$this->widgetSchema->setLabel('poll_choices', 'Choices');
    $this->widgetSchema->setNameFormat('quote[%s]');
  }
  
  public function saveEmbeddedForms($con = null, $forms = null)
  {
    if (null === $forms) {
      $choices = $this->getValue('poll_choices');
      $forms = $this->embeddedForms;

      foreach ($this->embeddedForms['poll_choices'] as $name => $form) {
        if(!isset($choices[$name])){
          unset($forms['poll_choices'][$name]);
        }
      }
    }
    return parent::saveEmbeddedForms($con, $forms);
  }
}