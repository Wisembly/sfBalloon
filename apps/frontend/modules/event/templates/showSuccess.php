<?php if(!$isAllowed): ?>
  <form action="<?php echo url_for('@event?short='.$event->getShort()) ?>" method="POST"> 
    <?php echo $form->renderGlobalErrors();?>  
    <?php echo $form->renderHiddenFields(); ?>
    Mot de passe : 
    <?php foreach($form as $f):?>
      <?php echo $f->renderError();?>
      <?php echo $f; ?>
    <?php endforeach;?>
      <input type="submit" value="Envoyer">  
  </form>
<?php else: ?>
  <h2><?php echo $event->getName(); ?></h2>
  
  <ul>
    <?php foreach($event->getWalls() as $wall):?>
    <li>
      <?php echo link_to($wall->getName(), sprintf('@wall?event=%s&wall=%s', $event->getShort(), $wall->getShort())); ?>
    </li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>