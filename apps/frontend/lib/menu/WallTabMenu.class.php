<?php

class WallTabMenu extends ioMenu
{
  protected $event;
  protected $wall;

  public function render($depth = null, $renderAsChild = false)
  {
    $event = $this->getAttribute('event');
    $wall = $this->getAttribute('wall');

    $this->addChild('Dernière', sprintf("@wall?event=%s&wall=%s", $event, $wall));
    $this->addChild('Populaire', sprintf("@wall?event=%s&wall=%s&sort=top", $event, $wall));
    $this->addChild('Réponses', sprintf("@wall_answers?event=%s&wall=%s", $event, $wall));
    $this->addChild('Favoris', sprintf("@wall_favoris?event=%s&wall=%s", $event, $wall));

    return parent::render($depth = null, $renderAsChild = false);
  }
}