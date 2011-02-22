<?php

class WallTabMenu extends ioMenu
{
  protected $event;
  protected $wall;

  public function render($depth = null, $renderAsChild = false)
  {
    $event = $this->event;
    $wall = $this->wall;

    $this->addChild('Dernière', sprintf("@wall?event=%s&wall=%s", $event, $wall));
    $this->addChild('Populaire', sprintf("@wall?event=%s&wall=%s&sort=trop", $event, $wall));
    $this->addChild('Réponses', '');

    return parent::render($depth = null, $renderAsChild = false);
  }

  public function setEvent($event)
  {
    $this->event = $event;
  }

  public function setWall($wall)
  {
    $this->wall = $wall;
  }

}