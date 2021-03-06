<?php

/**
 * BasePollAnswer
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $choice_id
 * @property integer $quote_id
 * @property integer $source_id
 * @property integer $user_id
 * @property string $token
 * @property PollChoice $Choice
 * @property Quote $Quote
 * @property Source $Source
 * @property sfGuardUser $User
 * 
 * @method integer     getChoiceId()  Returns the current record's "choice_id" value
 * @method integer     getQuoteId()   Returns the current record's "quote_id" value
 * @method integer     getSourceId()  Returns the current record's "source_id" value
 * @method integer     getUserId()    Returns the current record's "user_id" value
 * @method string      getToken()     Returns the current record's "token" value
 * @method PollChoice  getChoice()    Returns the current record's "Choice" value
 * @method Quote       getQuote()     Returns the current record's "Quote" value
 * @method Source      getSource()    Returns the current record's "Source" value
 * @method sfGuardUser getUser()      Returns the current record's "User" value
 * @method PollAnswer  setChoiceId()  Sets the current record's "choice_id" value
 * @method PollAnswer  setQuoteId()   Sets the current record's "quote_id" value
 * @method PollAnswer  setSourceId()  Sets the current record's "source_id" value
 * @method PollAnswer  setUserId()    Sets the current record's "user_id" value
 * @method PollAnswer  setToken()     Sets the current record's "token" value
 * @method PollAnswer  setChoice()    Sets the current record's "Choice" value
 * @method PollAnswer  setQuote()     Sets the current record's "Quote" value
 * @method PollAnswer  setSource()    Sets the current record's "Source" value
 * @method PollAnswer  setUser()      Sets the current record's "User" value
 * 
 * @package    balloon
 * @subpackage model
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
abstract class BasePollAnswer extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('poll_answer');
        $this->hasColumn('choice_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('quote_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('source_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('token', 'string', 40, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 40,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('PollChoice as Choice', array(
             'local' => 'choice_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Quote', array(
             'local' => 'quote_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Source', array(
             'local' => 'source_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasOne('sfGuardUser as User', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $countcache0 = new CountCache(array(
             'relations' => 
             array(
              'Choice' => 
              array(
              'columnName' => 'votes_count',
              'foreignAlias' => 'Answers',
              ),
             ),
             ));
        $this->actAs($countcache0);
    }
}