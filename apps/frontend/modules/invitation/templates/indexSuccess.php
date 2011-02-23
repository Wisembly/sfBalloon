<?php use_helper('I18N') ?>
<div id="admin_event_edit">
    <?php echo link_to('Retour à l\'event '.$eventId,sprintf('@event?short=%s', $eventId)); ?>
</div>
<div class="entete">
    <h1>Inviter des personnes à gérer l'événement</h1>
</div>
<br/>
<div class="col-100">
    <div class="tab-center">Vous pouvez inviter n'importe qui à gérer votre évènement avec vous, tout en lui allouant les rôles que vous voulez.</div>
</div>
<form action="<?php echo url_for(sprintf('@invitation_create?event=%s', $eventId)) ?>" method="post">
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
          <input class="register" type="submit" name="register" value="<?php echo __('Inviter', null, 'sf_guard') ?>" />
    </div>
    </div>
</form>
<br/>
