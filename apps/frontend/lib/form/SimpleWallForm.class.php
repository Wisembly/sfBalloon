<?php

class SimpleWallForm extends WallForm
{
  public function configure()
  {
  	parent::configure();
  	
  	$fields = array('name', 'lang', 'short_description');
  	
  	if ($this->getObject()->supports('twitter')) {
  		array_push($fields, 'tw_hashtag');
  	}

  	if ($this->getObject()->supports('sms')) {
  		array_push($fields, 'sms_hashtag');
  	}

  	if ($this->getObject()->supports('moderation')) {
  		array_push($fields, 'is_moderated');
  	}

  	if ($this->getObject()->supports('poll')) {
  		array_push($fields, 'survey_actived');
  	}

    $this->useFields($fields);
  }
}