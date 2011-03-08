<?php

class SimpleEventForm extends EventForm
{
  
  public function configure() 
  {
    parent::configure();
    $this->useFields(array('name', 'short_description', 'landing_html', 'logo', 'password'));
    
    $this->widgetSchema['logo'] = new sfWidgetFormInputFile(array(
      'label' => 'Logo'
    ));

    $this->validatorSchema['logo'] = new sfValidatorFile(array(
      'path' => sfConfig::get('sf_upload_dir').'/events',
      'required' => false, 
      'mime_types' => 'web_images'));
      
    $this->setWidget('lang', new sfWidgetFormI18nChoiceLanguage());
    $this->setValidator('lang', new sfValidatorI18nChoiceLanguage());
    
    $this->widgetSchema->setNameFormat('event[%s]');
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  }
  
}