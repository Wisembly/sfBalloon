<?php

require_once dirname(__FILE__).'/../bootstrap/unit.php';
require_once dirname(__FILE__).'/TestFunctions.php';

// Database connection
$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'test', true);
new sfDatabaseManager($configuration);
 
$user = create_user();
$user->save();

$user2 = create_user();
$user2->save();

$user3 = create_user();
$user3->save();

$event = create_event();
$event->save();


$date = new Datetime();
$date1 = new DateTime();
$date2 = new Datetime();

$date1->sub(date_interval_create_from_date_string('15 days'));
$date2->add(date_interval_create_from_date_string('15 days'));

$wall1 = create_wall(array(
	'event_id' 				=> $event->getId(),
	'name'						=> 'SIP Salle 1',
	'start'						=> $date1->getTimestamp(),
	'stop'						=> $date2->getTimestamp(),
	'real_start_date'	=> $date->getTimestamp()
));


$event->Walls[] = $wall1;

$event->save();

$authgroup = create_authgroup(array('name' => 'Admin'));
$authgroup->save();

$authgroup2 = create_authgroup(array('name' => 'Modo'));
$authgroup2->save();

$authgroup3 = create_authgroup(array('name' => 'Anim'));
$authgroup3->save();


$auth = create_auth(array(
	'user_id' 					=> $user->getId(),
	'event_id'					=> $event->getId(),
	'group_id'					=> $authgroup->getId()
));
$auth->save();

$auth2 = create_auth(array(
	'user_id' 					=> $user2->getId(),
	'event_id'					=> $event->getId(),
	'group_id'					=> $authgroup2->getId()
));
$auth2->save();

$auth3 = create_auth(array(
	'user_id' 					=> $user3->getId(),
	'event_id'					=> $event->getId(),
	'group_id'					=> $authgroup3->getId()
));
$auth3->save();


$t = new lime_test(14);
$t->comment('User Auth and Group');
$t->is($user->getRoleByRessource($event), 'Admin', 'User1 is an admin of Event1');
$t->isnt($user2->getRoleByRessource($event), 'Admin', 'User2 isnt an admin of Event1');
$t->isnt($user->getRoleByRessource($event), 'Modo', 'User1 isnt an modo of Event1');
$t->is($user->can('update', $event), true, 'User1 can update the event');
$t->is($user->can('add_user', $event), true, 'User1 can add user to the event');
$t->is($user2->can('add_user', $event), false, 'User2 can add user to the event');
$t->is($user2->can('update', $event), false, 'User2 canot update the event');

$t->is($user->can('fav_quote', $wall1), true, 'User1 can fav quote on the wall');
$t->is($user2->can('fav_quote', $wall1), true, 'User2 can fav quote on the wall');

$t->is($user->can('show_moderating_quotes', $wall1), true, 'User2 can show moderating quote on the wall');
$t->is($user2->can('show_moderating_quotes', $wall1), true, 'User2 can show moderating quote on the wall');
$t->is($user3->can('show_moderating_quotes', $wall1), false, 'User2 cannot show moderating quote on the wall');
$t->is($user3->can('show_moderating_quotes', new stdClass()), false, 'User2 cannot show moderating quote on a random object');
$t->is($user3->can('not_existing', $wall1), false, 'User2 cannot perform an none existing method on a object');