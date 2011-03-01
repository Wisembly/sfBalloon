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
<div id="centerpage">

  <div id="place_content">

    <div id="admin_event_members">
      <?php echo link_to('Gérer les Utilisateurs',sprintf('@invitation?event=%s', $event->getShort())); ?>
    </div>
    <div id="admin_edit_event">
      <?php echo link_to("Modifier l'événement",sprintf('@event_edit?short=%s', $event->getShort())); ?>
    </div>
    <div id="admin_edit_event">
      <?php echo link_to('Ajouter un wall',sprintf('@event_add_wall?short=%s', $event->getShort())); ?>
    </div>
    <br />
  
    <div id="place_1" class="place_edit">
      <h2><?php echo $event->getName(); ?></h2>
    </div>
    <br />
    <ul id="events">
      <?php foreach($event->getWalls() as $wall):?>
        <?php if($wall->isAvailable()): ?>
        <li>
          <?php echo link_to($wall->getName(), sprintf('@wall?event=%s&wall=%s', $event->getShort(), $wall->getShort()) ); ?>  
        </li> 
        <?php endif;?>
      <?php endforeach; ?>
    </ul>
  </div>  
</div>
<?php endif; ?>