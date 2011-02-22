<?php

class SimpleWallForm extends WallForm
{
  public function configure()
  {
  	parent::configure();

    $this->useFields(array('name','tw_hashtag','sms_hashtag', 'lang', 'is_moderated', 'short_description', 'survey_actived'));

    $this->setWidget('lang', new sfWidgetFormI18nChoiceLanguage());
    $this->setValidator('lang', new sfValidatorI18nChoiceLanguage());
  }
}