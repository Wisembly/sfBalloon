<?php

class WallActions
{
  public static function getActions()
  {
    return array(
      'sms'         => 'sms_allowed',
      'twitter'     => 'tw_allowed',
      'widget'      => 'widget_allowed',
      'email'       => 'email_allowed',
      'moderation'  => 'moderation_allowed',
      'poll'        => 'polls_allowed',
      'form'        => 'forms_allowed',
      'export'      => 'export_allowed',
    );
  }
}