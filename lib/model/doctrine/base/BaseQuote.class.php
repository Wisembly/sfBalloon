<?php

/**
 * BaseQuote
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $wall_id
 * @property integer $user_id
 * @property integer $source_id
 * @property string $tw_username
 * @property string $quote
 * @property integer $votes_count
 * @property boolean $has_answer
 * @property boolean $is_validated
 * @property boolean $is_poll
 * @property string $token
 * @property string $tweet_id
 * @property boolean $is_favori
 * @property integer $poll_duration
 * @property boolean $is_poll_active
 * @property Wall $Wall
 * @property sfGuardUser $User
 * @property Source $Source
 * @property Doctrine_Collection $Answers
 * @property Doctrine_Collection $PollChoices
 * @property Doctrine_Collection $PollAnswers
 * @property Doctrine_Collection $Votes
 * 
 * @method integer             getWallId()         Returns the current record's "wall_id" value
 * @method integer             getUserId()         Returns the current record's "user_id" value
 * @method integer             getSourceId()       Returns the current record's "source_id" value
 * @method string              getTwUsername()     Returns the current record's "tw_username" value
 * @method string              getQuote()          Returns the current record's "quote" value
 * @method integer             getVotesCount()     Returns the current record's "votes_count" value
 * @method boolean             getHasAnswer()      Returns the current record's "has_answer" value
 * @method boolean             getIsValidated()    Returns the current record's "is_validated" value
 * @method boolean             getIsPoll()         Returns the current record's "is_poll" value
 * @method string              getToken()          Returns the current record's "token" value
 * @method string              getTweetId()        Returns the current record's "tweet_id" value
 * @method boolean             getIsFavori()       Returns the current record's "is_favori" value
 * @method integer             getPollDuration()   Returns the current record's "poll_duration" value
 * @method boolean             getIsPollActive()   Returns the current record's "is_poll_active" value
 * @method Wall                getWall()           Returns the current record's "Wall" value
 * @method sfGuardUser         getUser()           Returns the current record's "User" value
 * @method Source              getSource()         Returns the current record's "Source" value
 * @method Doctrine_Collection getAnswers()        Returns the current record's "Answers" collection
 * @method Doctrine_Collection getPollChoices()    Returns the current record's "PollChoices" collection
 * @method Doctrine_Collection getPollAnswers()    Returns the current record's "PollAnswers" collection
 * @method Doctrine_Collection getVotes()          Returns the current record's "Votes" collection
 * @method Quote               setWallId()         Sets the current record's "wall_id" value
 * @method Quote               setUserId()         Sets the current record's "user_id" value
 * @method Quote               setSourceId()       Sets the current record's "source_id" value
 * @method Quote               setTwUsername()     Sets the current record's "tw_username" value
 * @method Quote               setQuote()          Sets the current record's "quote" value
 * @method Quote               setVotesCount()     Sets the current record's "votes_count" value
 * @method Quote               setHasAnswer()      Sets the current record's "has_answer" value
 * @method Quote               setIsValidated()    Sets the current record's "is_validated" value
 * @method Quote               setIsPoll()         Sets the current record's "is_poll" value
 * @method Quote               setToken()          Sets the current record's "token" value
 * @method Quote               setTweetId()        Sets the current record's "tweet_id" value
 * @method Quote               setIsFavori()       Sets the current record's "is_favori" value
 * @method Quote               setPollDuration()   Sets the current record's "poll_duration" value
 * @method Quote               setIsPollActive()   Sets the current record's "is_poll_active" value
 * @method Quote               setWall()           Sets the current record's "Wall" value
 * @method Quote               setUser()           Sets the current record's "User" value
 * @method Quote               setSource()         Sets the current record's "Source" value
 * @method Quote               setAnswers()        Sets the current record's "Answers" collection
 * @method Quote               setPollChoices()    Sets the current record's "PollChoices" collection
 * @method Quote               setPollAnswers()    Sets the current record's "PollAnswers" collection
 * @method Quote               setVotes()          Sets the current record's "Votes" collection
 * 
 * @package    balloon
 * @subpackage model
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
abstract class BaseQuote extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('quote');
        $this->hasColumn('wall_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('source_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('tw_username', 'string', 30, array(
             'type' => 'string',
             'length' => 30,
             ));
        $this->hasColumn('quote', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('votes_count', 'integer', null, array(
             'type' => 'integer',
             'default' => 0,
             ));
        $this->hasColumn('has_answer', 'boolean', null, array(
             'type' => 'boolean',
             'default' => 0,
             ));
        $this->hasColumn('is_validated', 'boolean', null, array(
             'type' => 'boolean',
             'default' => 0,
             ));
        $this->hasColumn('is_poll', 'boolean', null, array(
             'type' => 'boolean',
             'default' => 0,
             ));
        $this->hasColumn('token', 'string', 40, array(
             'type' => 'string',
             'length' => 40,
             ));
        $this->hasColumn('tweet_id', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('is_favori', 'boolean', null, array(
             'type' => 'boolean',
             'default' => 0,
             ));
        $this->hasColumn('poll_duration', 'integer', 2, array(
             'type' => 'integer',
             'default' => 1,
             'length' => 2,
             ));
        $this->hasColumn('is_poll_active', 'boolean', null, array(
             'type' => 'boolean',
             'default' => 1,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Wall', array(
             'local' => 'wall_id',
             'foreign' => 'id'));

        $this->hasOne('sfGuardUser as User', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasOne('Source', array(
             'local' => 'source_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasMany('Answer as Answers', array(
             'local' => 'id',
             'foreign' => 'quote_id',
             'cascade' => array(
             0 => 'delete',
             )));

        $this->hasMany('PollChoice as PollChoices', array(
             'local' => 'id',
             'foreign' => 'quote_id',
             'cascade' => array(
             0 => 'delete',
             )));

        $this->hasMany('PollAnswer as PollAnswers', array(
             'local' => 'id',
             'foreign' => 'quote_id'));

        $this->hasMany('Vote as Votes', array(
             'local' => 'id',
             'foreign' => 'quote_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $softdelete0 = new Doctrine_Template_SoftDelete();
        $this->actAs($timestampable0);
        $this->actAs($softdelete0);
    }
}