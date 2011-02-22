<?php use_helper('I18N') ?>

<form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
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
                <?php endif ?>
            <?php endforeach ?>
        </div>
        <div class="clear"></div>
        <div class="tab-center">
            <input class="login" type="submit" value="<?php echo __('Signin', null, 'sf_guard') ?>" />
            <br/>
            <?php $routes = $sf_context->getRouting()->getRoutes() ?>
            <?php if (isset($routes['sf_guard_forgot_password'])): ?>
            <a href="<?php echo url_for('@sf_guard_forgot_password') ?>"><?php echo __('Forgot your password?', null, 'sf_guard') ?></a>
            <?php endif; ?>

            <?php if (isset($routes['sf_guard_register'])): ?>
            &nbsp; <a href="<?php echo url_for('@sf_guard_register') ?>"><?php echo __('Want to register?', null, 'sf_guard') ?></a>
            <?php endif; ?>
        </div>
    </div>
</form>
<br/>