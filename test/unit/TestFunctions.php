<?php

function create_quote($defaults = array())
{
	$quote = new Quote();
	$quote->fromArray(array_merge(array(
		'quote'						=> 'Question'
	), $defaults));
	
	return $quote;
}

function create_user($defaults = array())
{
	$user = new sfGuardUser();
  $user->fromArray(array_merge(array(
    'email_address' 	=> uniqid().'clement@balloonup.com',
		'username'				=> uniqid().'dator'
  ), $defaults));
 
  return $user;
}

function create_event($defaults = array())
{
	$event = new Event();
	$event->fromArray(array_merge(array(
		'name'						=> 'Start In Paris',
		'short'						=> 'sip_'.uniqid(),
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

function create_wall($defaults = array())
{
	$event = new Wall();
	$event->fromArray(array_merge(array(
		'name'						=> 'Session',
		'short'						=> 'sip'.uniqid(),
		'logo'						=> '12356789.jpg'
	), $defaults));
	
	return $event;
}
