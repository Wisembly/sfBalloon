<?php

/**
 * BaseOffer
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property float $price
 * @property boolean $sms_allowed
 * @property boolean $tw_allowed
 * @property boolean $email_allowed
 * @property boolean $moderation_allowed
 * @property boolean $polls_allowed
 * @property timestamp $duration_time
 * @property boolean $forms_allowed
 * @property Subscription $Subscription
 * @property Voucher $Voucher
 * 
 * @method string       getName()               Returns the current record's "name" value
 * @method float        getPrice()              Returns the current record's "price" value
 * @method boolean      getSmsAllowed()         Returns the current record's "sms_allowed" value
 * @method boolean      getTwAllowed()          Returns the current record's "tw_allowed" value
 * @method boolean      getEmailAllowed()       Returns the current record's "email_allowed" value
 * @method boolean      getModerationAllowed()  Returns the current record's "moderation_allowed" value
 * @method boolean      getPollsAllowed()       Returns the current record's "polls_allowed" value
 * @method timestamp    getDurationTime()       Returns the current record's "duration_time" value
 * @method boolean      getFormsAllowed()       Returns the current record's "forms_allowed" value
 * @method Subscription getSubscription()       Returns the current record's "Subscription" value
 * @method Voucher      getVoucher()            Returns the current record's "Voucher" value
 * @method Offer        setName()               Sets the current record's "name" value
 * @method Offer        setPrice()              Sets the current record's "price" value
 * @method Offer        setSmsAllowed()         Sets the current record's "sms_allowed" value
 * @method Offer        setTwAllowed()          Sets the current record's "tw_allowed" value
 * @method Offer        setEmailAllowed()       Sets the current record's "email_allowed" value
 * @method Offer        setModerationAllowed()  Sets the current record's "moderation_allowed" value
 * @method Offer        setPollsAllowed()       Sets the current record's "polls_allowed" value
 * @method Offer        setDurationTime()       Sets the current record's "duration_time" value
 * @method Offer        setFormsAllowed()       Sets the current record's "forms_allowed" value
 * @method Offer        setSubscription()       Sets the current record's "Subscription" value
 * @method Offer        setVoucher()            Sets the current record's "Voucher" value
 * 
 * @package    balloon
 * @subpackage model
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id$
 */
abstract class BaseOffer extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('offer');
        $this->hasColumn('name', 'string', 150, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 150,
             ));
        $this->hasColumn('price', 'float', null, array(
             'type' => 'float',
             ));
        $this->hasColumn('sms_allowed', 'boolean', null, array(
             'type' => 'boolean',
             'default' => 0,
             ));
        $this->hasColumn('tw_allowed', 'boolean', null, array(
             'type' => 'boolean',
             'default' => 0,
             ));
        $this->hasColumn('email_allowed', 'boolean', null, array(
             'type' => 'boolean',
             'default' => 0,
             ));
        $this->hasColumn('moderation_allowed', 'boolean', null, array(
             'type' => 'boolean',
             'default' => 0,
             ));
        $this->hasColumn('polls_allowed', 'boolean', null, array(
             'type' => 'boolean',
             'default' => 0,
             ));
        $this->hasColumn('duration_time', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('forms_allowed', 'boolean', null, array(
             'type' => 'boolean',
             'default' => 0,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Subscription', array(
             'local' => 'id',
             'foreign' => 'offer_id'));

        $this->hasOne('Voucher', array(
             'local' => 'id',
             'foreign' => 'offer_id'));
    }
}