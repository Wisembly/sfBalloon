<div class="entete">
    <h1>Editer la question</h1>
</div>

<form action="<?php echo url_for(sprintf("@quote_edit?event=%s&wall=%s&quote=%s", $eventId, $wallId, $quoteId)); ?>" method="post">
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

