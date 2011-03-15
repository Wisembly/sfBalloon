<div id="poster">
  <div id="compteur">140</div>
    <form action="<?php echo url_for(sprintf("@quote_create?event=%s&wall=%s", $eventId, $wallId)); ?>" method="post">
      <div id="textarea">
          <?php $cp = 0;?>
          <?php foreach ($form as $field): ?>
              <?php if(!$field->isHidden()):?>
                      <?php if($cp == 1):?>
                          <?php echo '<strong>'.$field->renderLabel().'</strong>'; ?>
                          <?php echo $field->render(); ?>
                          <?php if($field->renderError()) { echo '<p>'.$field->renderError()."</p>"; }?>
                      <?php endif ?>
                      <?php if($cp == 2):?>
                          <div class="poll-duration">
                          <?php echo $field->renderLabel(); ?>
                          <?php echo $field->render(); ?>
                          <?php if($field->renderError()) { echo '<p>'.$field->renderError()."</p>"; }?>
                          </div>
                      <?php endif ?>
                      <?php if($cp >= 3):?>
                          <div class="poll">
                              <?php echo $field->renderLabel();?>
                          <?php foreach($field as $poll) :?>
                              <?php foreach($poll as $poll_field) :?>
                                  <?php echo $poll_field->render(); ?>
                              <?php endforeach ?>
                          <?php endforeach ?>
                          </div>
                      <?php endif ?>
              <?php else: ?>
                  <?php echo $field->render();?>
              <?php endif ?>
              <?php $cp++;?>
          <?php endforeach ?>
      </div>
      <span><?php echo link_to('Retour à l\'event '.$event->getShort(),sprintf('@event?short=%s', $event->getShort())); ?></span>
      <div id="bt_send"><input type="submit" value="Envoyer" class="envoyer"></div>
    </form>
</div>
<div class="clear"></div>
  <div id="menu">
    <?php echo $menu->render(); ?>
  </div>