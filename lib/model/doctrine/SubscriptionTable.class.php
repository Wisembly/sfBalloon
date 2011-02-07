<?php

class SubscriptionTable extends Doctrine_Table
{
  public function findOneByWall($wall)
  {
    return $this->createQuery('s')
                ->leftJoin('s.Event e')
                ->leftJoin('s.Offer o')
                ->leftJoin('s.Wall w')
                ->where('s.wall_id = ?', $wall->getId())
                ->andWhere('s.event_id = ?', $wall->getEvent()->getId())
                ->fetchOne();
  }
}