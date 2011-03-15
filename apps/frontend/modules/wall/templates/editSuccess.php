<div id="admin_event_edit-bt">
    <div class="img-back"></div>
    <span><?php echo link_to('Retour à l\'event '.$event->getShort(),sprintf('@event?short=%s', $event->getShort())); ?></span>
</div>
<div class="entete">
    <h1>Editer l'event</h1>
</div>
  <form action="<?php echo url_for(sprintf("@wall_edit?event=%s&wall=%s", $eventId, $wallId)); ?>" enctype="multipart/form-data" method="post">
    <div class="sign_table">
        <div class="col-25">&nbsp;</div>
        <div class="col-75">
            <?php foreach ($form as $field): ?>
                <?php if(!$field->isHidden()):?>
                    <div class="col-100">
                        <div id="label"><?php echo $field->renderLabel(); ?></div>
                        <div id="field"><?php echo $field->render(); ?></div>
                        <div id="error"><?php echo $field->renderError(); ?></div>
                    </div>
                <?php else: ?>
                    <?php echo $field->render(); ?>
                <?php endif ?>
            <?php endforeach ?>
        </div>
        <div class="clear"></div>
        <div class="tab-center">
            <input class="edit" type="submit" value="Modifier">
        </div>
    </div>
  </form>
<br/>
