<?php

/**
 * Wall
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    balloon
 * @subpackage model
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id$
 */
class Wall extends BaseWall
{
  public function getAuth()
  {
    return $this->getEvent()->getAuth();
  }
  
  public function isModerated()
  {
    return ($this->getIsModerated());
  }
  
  public function getPublishedQuotes()
  {
    return $this->getQuotes();
  }
}
