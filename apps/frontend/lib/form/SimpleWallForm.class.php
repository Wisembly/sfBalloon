<?php

class SimpleWallForm extends WallForm
{
  public function configure()
  {
    $this->useFields(array('name','tw_hashtag','sms_hashtag', 'lang', 'is_moderated', 'short_description', 'survey_actived'));
  }
}