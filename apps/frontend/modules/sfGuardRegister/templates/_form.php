<?php use_helper('I18N') ?>

<form action="<?php echo url_for('@sf_guard_register?plan='.$plan) ?>" method="post">
    <div class="sign_table">
        <div class="col-50">
            <?php $cp = 0; ?>
            <?php foreach ($form as $field): ?>
                <?php if(!$field->isHidden()):?>
                    <div class="col-100">
                        <div id="label"><?php echo $field->renderLabel(); ?></div>
                        <div id="field"><?php echo $field->render(); ?></div>
                        <div id="error"><?php echo $field->renderError(); ?></div>
                    </div>
                    <?php if($cp == 2) echo'</div><div class="col-50">';?>
                    <?php if($cp == 5) echo'</div><div class="tab-center">';?>
                    <?php $cp++;?>
                <?php else :?>
                    <?php echo $field->render(); ?>
                <?php endif ?>
            <?php endforeach ?>
        </div>
        <div class="tab-center">
            <input class="register" type="submit" name="register" value="<?php echo __('Register', null, 'sf_guard') ?>" />
        </div>
    </div>
</form>
<br/>