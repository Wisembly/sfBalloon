<?php

/**
 * BaseStatWall
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $wall_id
 * @property integer $total_questions
 * @property integer $validated_questions
 * @property integer $total_votes
 * @property integer $max_connceted_users
 * @property Wall $Wall
 * 
 * @method integer  getWallId()              Returns the current record's "wall_id" value
 * @method integer  getTotalQuestions()      Returns the current record's "total_questions" value
 * @method integer  getValidatedQuestions()  Returns the current record's "validated_questions" value
 * @method integer  getTotalVotes()          Returns the current record's "total_votes" value
 * @method integer  getMaxConncetedUsers()   Returns the current record's "max_connceted_users" value
 * @method Wall     getWall()                Returns the current record's "Wall" value
 * @method StatWall setWallId()              Sets the current record's "wall_id" value
 * @method StatWall setTotalQuestions()      Sets the current record's "total_questions" value
 * @method StatWall setValidatedQuestions()  Sets the current record's "validated_questions" value
 * @method StatWall setTotalVotes()          Sets the current record's "total_votes" value
 * @method StatWall setMaxConncetedUsers()   Sets the current record's "max_connceted_users" value
 * @method StatWall setWall()                Sets the current record's "Wall" value
 * 
 * @package    balloon
 * @subpackage model
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id$
 */
abstract class BaseStatWall extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('stat_wall');
        $this->hasColumn('wall_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('total_questions', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             ));
        $this->hasColumn('validated_questions', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             ));
        $this->hasColumn('total_votes', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             ));
        $this->hasColumn('max_connceted_users', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Wall', array(
             'local' => 'wall_id',
             'foreign' => 'id'));
    }
}