<?php

/**
 * BaseAnswer
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $quote_id
 * @property integer $user_id
 * @property text $answer
 * @property Quote $Quote
 * @property sfGuardUser $User
 * 
 * @method integer     getQuoteId()  Returns the current record's "quote_id" value
 * @method integer     getUserId()   Returns the current record's "user_id" value
 * @method text        getAnswer()   Returns the current record's "answer" value
 * @method Quote       getQuote()    Returns the current record's "Quote" value
 * @method sfGuardUser getUser()     Returns the current record's "User" value
 * @method Answer      setQuoteId()  Sets the current record's "quote_id" value
 * @method Answer      setUserId()   Sets the current record's "user_id" value
 * @method Answer      setAnswer()   Sets the current record's "answer" value
 * @method Answer      setQuote()    Sets the current record's "Quote" value
 * @method Answer      setUser()     Sets the current record's "User" value
 * 
 * @package    balloon
 * @subpackage model
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id$
 */
abstract class BaseAnswer extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('answer');
        $this->hasColumn('quote_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('answer', 'text', null, array(
             'type' => 'text',
             'notnull' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Quote', array(
             'local' => 'quote_id',
             'foreign' => 'id',
             'cascade' => array(
             0 => 'delete',
             )));

        $this->hasOne('sfGuardUser as User', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'cascade' => array(
             0 => 'delete',
             )));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $softdelete0 = new Doctrine_Template_SoftDelete();
        $this->actAs($timestampable0);
        $this->actAs($softdelete0);
    }
}