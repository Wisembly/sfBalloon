<?php

require_once dirname(__FILE__).'/../bootstrap/unit.php';
require_once dirname(__FILE__).'/TestFunctions.php';

// Database connection
$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'dev', true);
new sfDatabaseManager($configuration);

$t = new lime_test();


$email1= array(
    'from'    => "test".uniqid()."@test.com",
    'to'      => "question@votrequestion.com",
    'subject' => 'HEC',
    'content' => "Quelle est la couleur du cheval 

blanc ?",
    'envelop' => '[{"to": "question@votrequestion.com", "from": "test'.uniqid().'@test.com"}]'
  );
$email2=
  array(
    'from'    => "test".uniqid()."@test.com",
    'to'      => "hec@votrequestion.com",
    "subject" => "neziobfiezbofbeuzbfiubezibub zzebfez",
    'content' => "Quelle est la couleur du cheval blanc ?",
    'envelop' => '[{"to": "hec@votrequestion.com", "from": "test'.uniqid().'@test.com"}]'
  );

  $sg = new EmailGateway(new EmailParser(), new GatewayDbManager());
  $sg->setDispatcher(new sfEventDispatcher());
  $resp = $sg->handle($email1);

  $t->ok($sg->getEmail()->getEventCode() === "hec", 'The shortcode is OK');

  $t->ok($sg->getEmail()->getContent() == "Quelle est la couleur du cheval blanc ?", 'The content is valid');

  $t->ok($resp->getStatus() === null, 'The response code is ok');
  
  $sg = new EmailGateway(new EmailParser(), new GatewayDbManager());
  $sg->setDispatcher(new sfEventDispatcher());
  $resp = $sg->handle($email2);

  $t->ok($sg->getEmail()->getEventCode() === "hec", 'The shortcode is OK');
  $t->ok($sg->getEmail()->getContent() === "Quelle est la couleur du cheval blanc ?", 'The content is valid');
  $t->ok($resp->getStatus() === null, 'The response code is ok');