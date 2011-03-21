<?php

require_once dirname(__FILE__).'/../bootstrap/unit.php';
require_once dirname(__FILE__).'/TestFunctions.php';

// Database connection
$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'dev', true);
new sfDatabaseManager($configuration);

$t = new lime_test();

$smsVotes = array(
  array(
    'from'    => "124567890".uniqid(),
    'to'      => 235,
    'content' => 'HEC 1'
  ),
  array(
    'from'    => "1234567890".uniqid(),
    'to'      => 235,
    'content' => 'HEC
    1'
  )
);

$smsQuotes = array(
  array(
    'from'    => "124567890".uniqid(),
    'to'      => 235,
    'content' => 'HEC Quelle est la couleur du cheval blanc ?'
  ),
  array(
    'from'    => "1234567890".uniqid(),
    'to'      => 235,
    'content' => 'HEC
    Quelle est la couleur du cheval blanc ?'
  )
);


foreach($smsVotes as $sms){
  $sg = new SMSGateway(new SMSParser(), new SMSDbManager());
  $sg->setDispatcher(new sfEventDispatcher());
  $resp = $sg->handle($sms);

  $t->ok($sg->getSms()->getEventCode() === "HEC", 'The shortcode is OK');
  $t->ok($sg->getSms()->isNewQuote() === false, 'The shortcode is not a new Quote');
  $t->ok($sg->getSms()->isVoteToSurvey() === true, 'The shortcode is a vote to a survey');
  $t->ok($sg->getSms()->getContent() === "1", 'The content is valid');

  $t->ok($resp->getStatus() !== "ok", 'The response code is notok');
}


foreach($smsQuotes as $sms){
  $sg = new SMSGateway(new SMSParser(), new SMSDbManager());
  $sg->setDispatcher(new sfEventDispatcher());
  $resp = $sg->handle($sms); 

  $t->ok($sg->getSms()->getEventCode() === "HEC", 'The shortcode is OK');
  $t->ok($sg->getSms()->isNewQuote() === true, 'The shortcode is a new Quote');
  $t->ok($sg->getSms()->isVoteToSurvey() === false, 'The shortcode is not a vote to a survey');
  $t->ok($sg->getSms()->getContent() === "Quelle est la couleur du cheval blanc ?", 'The content is valid');
  
  $t->ok($resp->getStatus() === "ok", 'The response code is ok');
}