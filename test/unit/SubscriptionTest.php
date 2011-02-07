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
$offer = fetch_offer(1);

$subscription = $user->addSubscription($offer, $event, $wall);

/*
	Un utilisateur peut avoir plusieurs subscription.
	Un subscription représente un achat, lié a un plan.

	Par exemple, un utilisateur achete un event a 149€ (1 subscription), il a un wall gratos mais il veut un niouveau wall dans le meme event , il repasse a la caisse 149€ (2e subscription)

	Un utilisateur peut rachater plusieur events qui sont livré avec un wall de base
*/


$t = new lime_test(2);
$t->is($user->findSubscriptionForWall($wall)->getOffer()->getPrice(), '149', 'Subscription is for startup offer');
$t->isnt($user->findSubscriptionForWall($wall)->getOffer()->getPrice(), '590', 'Subscription is not for assoc');