<?php

class frontendConfiguration extends sfApplicationConfiguration
{
  public function configure()
  {
    $this->dispatcher->connect('sms.log_error', array($this, 'logErrorSms'));
    $this->dispatcher->connect('sms.log', array($this, 'logSms'));
  }

  public function logErrorSms(sfEvent $event)
  {
    $loger = new sfFileLogger($this->dispatcher,array(
      'file'    => sfConfig::get('sf_log_dir').'/sms_error_log.log',
      'type'    => 'sms'
    ));

    $loger->log(sprintf(
      "SMS Content: %s -- %s",
      $event['sms']->getContent(),
      $event['message']
    ), sfLogger::ERR);
  }

  public function logSms(sfEvent $event)
  {
    $loger = new sfFileLogger($this->dispatcher,array(
      'file'    => sfConfig::get('sf_log_dir').'/sms_log.log',
      'type'    => 'sms'
    ));

    $loger->log(sprintf(
      "From %s, To %s, Content: %s",
      $event['sms']->getFrom(),
      $event['sms']->getTo(),
      $event['sms']->getContent()
    ));
  }
}
