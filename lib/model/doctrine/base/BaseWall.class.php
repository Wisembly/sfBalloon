<?php

/**
 * BaseWall
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $event_id
 * @property string $name
 * @property string $tw_hashtag
 * @property string $sms_hashtag
 * @property string $last_tweet_id
 * @property string $lang
 * @property text $short_description
 * @property timestamp $start
 * @property timestamp $stop
 * @property timestamp $real_start_date
 * @property boolean $is_moderated
 * @property integer $alaune_quote_id
 * @property integer $survey_actived
 * @property string $feedback
 * @property boolean $has_custom_css
 * @property Event $Event
 * @property Doctrine_Collection $Quotes
 * @property Subscription $Subscription
 * @property Doctrine_Collection $StatWall
 * 
 * @method integer             getEventId()           Returns the current record's "event_id" value
 * @method string              getName()              Returns the current record's "name" value
 * @method string              getTwHashtag()         Returns the current record's "tw_hashtag" value
 * @method string              getSmsHashtag()        Returns the current record's "sms_hashtag" value
 * @method string              getLastTweetId()       Returns the current record's "last_tweet_id" value
 * @method string              getLang()              Returns the current record's "lang" value
 * @method text                getShortDescription()  Returns the current record's "short_description" value
 * @method timestamp           getStart()             Returns the current record's "start" value
 * @method timestamp           getStop()              Returns the current record's "stop" value
 * @method timestamp           getRealStartDate()     Returns the current record's "real_start_date" value
 * @method boolean             getIsModerated()       Returns the current record's "is_moderated" value
 * @method integer             getAlauneQuoteId()     Returns the current record's "alaune_quote_id" value
 * @method integer             getSurveyActived()     Returns the current record's "survey_actived" value
 * @method string              getFeedback()          Returns the current record's "feedback" value
 * @method boolean             getHasCustomCss()      Returns the current record's "has_custom_css" value
 * @method Event               getEvent()             Returns the current record's "Event" value
 * @method Doctrine_Collection getQuotes()            Returns the current record's "Quotes" collection
 * @method Subscription        getSubscription()      Returns the current record's "Subscription" value
 * @method Doctrine_Collection getStatWall()          Returns the current record's "StatWall" collection
 * @method Wall                setEventId()           Sets the current record's "event_id" value
 * @method Wall                setName()              Sets the current record's "name" value
 * @method Wall                setTwHashtag()         Sets the current record's "tw_hashtag" value
 * @method Wall                setSmsHashtag()        Sets the current record's "sms_hashtag" value
 * @method Wall                setLastTweetId()       Sets the current record's "last_tweet_id" value
 * @method Wall                setLang()              Sets the current record's "lang" value
 * @method Wall                setShortDescription()  Sets the current record's "short_description" value
 * @method Wall                setStart()             Sets the current record's "start" value
 * @method Wall                setStop()              Sets the current record's "stop" value
 * @method Wall                setRealStartDate()     Sets the current record's "real_start_date" value
 * @method Wall                setIsModerated()       Sets the current record's "is_moderated" value
 * @method Wall                setAlauneQuoteId()     Sets the current record's "alaune_quote_id" value
 * @method Wall                setSurveyActived()     Sets the current record's "survey_actived" value
 * @method Wall                setFeedback()          Sets the current record's "feedback" value
 * @method Wall                setHasCustomCss()      Sets the current record's "has_custom_css" value
 * @method Wall                setEvent()             Sets the current record's "Event" value
 * @method Wall                setQuotes()            Sets the current record's "Quotes" collection
 * @method Wall                setSubscription()      Sets the current record's "Subscription" value
 * @method Wall                setStatWall()          Sets the current record's "StatWall" collection
 * 
 * @package    balloon
 * @subpackage model
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
abstract class BaseWall extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('wall');
        $this->hasColumn('event_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('name', 'string', 150, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 150,
             ));
        $this->hasColumn('tw_hashtag', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             ));
        $this->hasColumn('sms_hashtag', 'string', 20, array(
             'type' => 'string',
             'length' => 20,
             ));
        $this->hasColumn('last_tweet_id', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('lang', 'string', 5, array(
             'type' => 'string',
             'length' => 5,
             ));
        $this->hasColumn('short_description', 'text', null, array(
             'type' => 'text',
             ));
        $this->hasColumn('start', 'timestamp', null, array(
             'type' => 'timestamp',
             'notnull' => true,
             ));
        $this->hasColumn('stop', 'timestamp', null, array(
             'type' => 'timestamp',
             'notnull' => true,
             ));
        $this->hasColumn('real_start_date', 'timestamp', null, array(
             'type' => 'timestamp',
             'notnull' => true,
             ));
        $this->hasColumn('is_moderated', 'boolean', null, array(
             'type' => 'boolean',
             'default' => 0,
             ));
        $this->hasColumn('alaune_quote_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('survey_actived', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('feedback', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('has_custom_css', 'boolean', null, array(
             'type' => 'boolean',
             'default' => 0,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Event', array(
             'local' => 'event_id',
             'foreign' => 'id'));

        $this->hasMany('Quote as Quotes', array(
             'local' => 'id',
             'foreign' => 'wall_id',
             'cascade' => array(
             0 => 'delete',
             )));

        $this->hasOne('Subscription', array(
             'local' => 'id',
             'foreign' => 'wall_id'));

        $this->hasMany('StatWall', array(
             'local' => 'id',
             'foreign' => 'wall_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $softdelete0 = new Doctrine_Template_SoftDelete();
        $sluggable0 = new Doctrine_Template_Sluggable(array(
             'name' => 'short',
             'unique' => true,
             'fields' => 
             array(
              0 => 'name',
             ),
             'canUpdate' => true,
             ));
        $countcache0 = new CountCache(array(
             'relations' => 
             array(
              'Event' => 
              array(
              'columnName' => 'wall_count',
              'foreignAlias' => 'Walls',
              ),
             ),
             ));
        $this->actAs($timestampable0);
        $this->actAs($softdelete0);
        $this->actAs($sluggable0);
        $this->actAs($countcache0);
    }
}