<?php

require_once dirname(__FILE__).'/../bootstrap/unit.php';

// Database connection
$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'test', true);
new sfDatabaseManager($configuration);
 
$user = create_user();
$user->save();

$user2 = create_user();
$user2->save();

$event = create_event();
$event->save();

$authgroup = create_authgroup(array('name' => 'Admin'));
$authgroup->save();

$authgroup2 = create_authgroup(array('name' => 'Modo'));
$authgroup2->save();

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


$t = new lime_test(3);
$t->comment('User Auth and Group');
$t->is($user->getAuth()->getGroup()->getName(), 'Admin', 'User is an admin');
$t->is($user2->getAuth()->getGroup()->getName(), 'Modo', 'User2 is an modo');
$t->isnt($user2->getAuth()->getGroup()->getName(), 'Admin', 'User2 isnt an admin');


function create_user($defaults = array())
{
	$user = new sfGuardUser();
  $user->fromArray(array_merge(array(
    'email_address' 	=> 'clement@balloonup.com',
		'username'				=> 'dator',
  ), $defaults));
 
  return $user;
}

function create_event($defaults = array())
{
	$event = new Event();
	$event->fromArray(array_merge(array(
		'name'						=> 'Start In Paris',
		'short'						=> 'sip',
		'logo'						=> '12356789.jpg'
	), $defaults));
	
	return $event;
}

function create_authgroup($defaults = array())
{
	$authgroup = new AuthGroup();
	$authgroup->fromArray(array_merge(array(
		'name'						=> 'Admin',
	), $defaults));
	
	return $authgroup;
}

function create_auth($defaults = array())
{
	$auth = new Auth();
	$auth->fromArray(array_merge(array(
	), $defaults));
	
	return $auth;
}