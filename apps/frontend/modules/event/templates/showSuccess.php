<h2><?php echo $event->getName(); ?></h2>

<ul>
  <?php foreach($event->getWalls() as $wall):?>
  <li>
    <?php echo link_to($wall->getName(), sprintf('@wall?event=%s&wall=%s', $event->getShort(), $wall->getShort())); ?>
  </li>
  <?php endforeach; ?>
</ul>