<?php
require_once dirname(__FILE__).'/../bootstrap/unit.php';
require_once dirname(__FILE__).'/TestFunctions.php';

$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'test', true);
new sfDatabaseManager($configuration);

$event = create_event();
$event->save();

$invitation = new Invitation();
$invitation->setEmail('clement@test.com');
$invitation->setEvent($event);
$invitation->setGroupId(2); // Modo
$invitation->save();

$t = new lime_test(2);
$t->isnt(Doctrine::getTable('Invitation')->findInvitedByEmail('clement@test.com'), false, 'existing invitation');
$t->is(Doctrine::getTable('Invitation')->findInvitedByEmail('test@test.com'), false, 'not existing invitation');