<?php

require_once dirname(__FILE__).'/../bootstrap/unit.php';
require_once dirname(__FILE__).'/TestFunctions.php';

// Database connection
$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'test', true);
new sfDatabaseManager($configuration);


$t = new lime_test(4);

$event = create_event();
$event->save();

$event = Doctrine::getTable('Event')->find($event->getId());
$t->comment('CountCache test');
$t->is($event->getWallCount(), 0, 'Event has no walls yet');

$wall = create_wall();
$wall2 = create_wall();

$event->Walls[] = $wall;
$event->Walls[] = $wall2;
$event->save();
$event = Doctrine::getTable('Event')->find($event->getId());
$t->is($event->getWallCount(), 2, 'Add 2 walls, Event has 2 walls');

$wall->delete();
$event = Doctrine::getTable('Event')->find($event->getId());

$t->is($event->getWallCount(), 1, 'Delete 1 wall, Event has 1 wall');

$wall2->delete();
$event = Doctrine::getTable('Event')->find($event->getId());

$t->is($event->getWallCount(), 0, 'Delete the last wall, Event has no wall');