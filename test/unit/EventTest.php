<?php

require_once dirname(__FILE__).'/../bootstrap/unit.php';

// Database connection
$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'test', true);
new sfDatabaseManager($configuration);

$event = create_event();
$event->save();

$date = new Datetime();
$date1 = new DateTime();
$date2 = new Datetime();

$date1->sub(date_interval_create_from_date_string('15 days'));
$date2->add(date_interval_create_from_date_string('15 days'));

for ($j=0; $j<2; $j++) {
	$wall = create_wall(array(
		'event_id' 				=> $event->getId(),
		'name'						=> 'SIP Salle '.$j,
		'start'						=> $date1->getTimestamp(),
		'stop'						=> $date2->getTimestamp(),
		'real_start_date'	=> $date->getTimestamp()
	));
	
	for ($i=0; $i<4; $i++) {
		$quote = create_quote(array('quote' => 'Question '.$i));
		$wall->Quotes[] = $quote;
	}
	
	$event->Walls[] = $wall;
}

$event->save();
$event->delete();

$t = new lime_test(4);
$t->comment('Softdelete test');
$t->isnt($event, null, 'Event is not deleted of the database');
$t->isnt($event->getDeletedAt(), null, 'Event is softdeleted');
$t->isnt($event->Walls[0]->getDeletedAt(), null, 'Wall1 is soft deleted');
$t->isnt($event->Walls[1]->getDeletedAt(), null, 'Wall2 is soft deleted');


function create_quote($defaults = array())
{
	$quote = new Quote();
	$quote->fromArray(array_merge(array(
		'quote'						=> 'Question'
	), $defaults));
	
	return $quote;
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

function create_wall($defaults = array())
{
	$event = new Wall();
	$event->fromArray(array_merge(array(
		'name'						=> 'Start In Paris',
		'short'						=> 'sip',
		'logo'						=> '12356789.jpg'
	), $defaults));
	
	return $event;
}