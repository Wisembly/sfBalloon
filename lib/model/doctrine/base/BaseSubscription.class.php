<?php

/**
 * BaseSubscription
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $user_id
 * @property integer $wall_id
 * @property integer $event_id
 * @property integer $voucher_id
 * @property integer $offer_id
 * @property boolean $is_payed
 * @property sfGuardUser $User
 * @property Event $Event
 * @property Wall $Wall
 * @property Offer $Offer
 * 
 * @method integer      getUserId()     Returns the current record's "user_id" value
 * @method integer      getWallId()     Returns the current record's "wall_id" value
 * @method integer      getEventId()    Returns the current record's "event_id" value
 * @method integer      getVoucherId()  Returns the current record's "voucher_id" value
 * @method integer      getOfferId()    Returns the current record's "offer_id" value
 * @method boolean      getIsPayed()    Returns the current record's "is_payed" value
 * @method sfGuardUser  getUser()       Returns the current record's "User" value
 * @method Event        getEvent()      Returns the current record's "Event" value
 * @method Wall         getWall()       Returns the current record's "Wall" value
 * @method Offer        getOffer()      Returns the current record's "Offer" value
 * @method Subscription setUserId()     Sets the current record's "user_id" value
 * @method Subscription setWallId()     Sets the current record's "wall_id" value
 * @method Subscription setEventId()    Sets the current record's "event_id" value
 * @method Subscription setVoucherId()  Sets the current record's "voucher_id" value
 * @method Subscription setOfferId()    Sets the current record's "offer_id" value
 * @method Subscription setIsPayed()    Sets the current record's "is_payed" value
 * @method Subscription setUser()       Sets the current record's "User" value
 * @method Subscription setEvent()      Sets the current record's "Event" value
 * @method Subscription setWall()       Sets the current record's "Wall" value
 * @method Subscription setOffer()      Sets the current record's "Offer" value
 * 
 * @package    balloon
 * @subpackage model
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
abstract class BaseSubscription extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('subscription');
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('wall_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('event_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('voucher_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('offer_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('is_payed', 'boolean', null, array(
             'type' => 'boolean',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser as User', array(
             'local' => 'user_id',
             'foreign' => 'id'));

        $this->hasOne('Event', array(
             'local' => 'event_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasOne('Wall', array(
             'local' => 'wall_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasOne('Offer', array(
             'local' => 'offer_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}