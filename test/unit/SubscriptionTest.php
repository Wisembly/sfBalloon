<?php

require_once dirname(__FILE__).'/../bootstrap/unit.php';
require_once dirname(__FILE__).'/TestFunctions.php';

// Database connection
$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'test', true);
new sfDatabaseManager($configuration);

$user = create_user();
$user->save();

$event = create_event();
$wall = create_wall();
$wall2 = create_wall();
$startup_offer = fetch_offer(1);
$assoc_offer = fetch_offer(2);

$subscription = $user->addSubscription($startup_offer, $event, $wall);

$subscription2 = $user->addSubscription($assoc_offer, $event, $wall2);
/*
	Un utilisateur peut avoir plusieurs subscription.
	Un subscription représente un achat, lié a un plan.

	Par exemple, un utilisateur achete un event a 149€ (1 subscription), il a un wall gratos mais il veut un niouveau wall dans le meme event , il repasse a la caisse 149€ (2e subscription)

	Un utilisateur peut rachater plusieur events qui sont livré avec un wall de base
*/


$t = new lime_test(13);
$t->is($user->findSubscriptionForWall($wall)->getOffer()->getPrice(), '149', 'Subscription is for startup offer');
$t->isnt($user->findSubscriptionForWall($wall)->getOffer()->getPrice(), '590', 'Subscription is not for assoc');
$t->isnt($wall->supports('sms'), true, 'Wall (startup) does not support sms');
$t->is($wall->supports('twitter'), true, 'Wall (startup) does support twitter');
$t->is($wall->supports('form'), false, 'Wall (startup) does support form');
$t->is($wall->supports('moderation'), true, 'Wall (startup) does support moderation');
$t->isnt($wall->supports('export'), true, 'Wall (startup) does not support export');

$t->is($wall2->supports('sms'), true, 'Wall (assoc) does support sms');
$t->is($wall2->supports('twitter'), true, 'Wall (assoc) does support twitter');
$t->is($wall2->supports('form'), false, 'Wall (assoc) does  support form');
$t->isnt($wall2->supports('moderation'), false, 'Wall (assoc) does  support moderation');
$t->is($wall2->supports('export'), true, 'Wall (assoc) does  support export');
try{
  $wall->support('lorem');
  $t->fail('The support method does not care about exception with action unexistant');
}catch(Exception $e){
  $t->pass('The support method raise exception with action unexistant');
}