<?php use_helper('I18N') ?>
<?php use_helper('Url'); ?> 
<div class="entete">
    <h1><?php echo __('Register', null, 'sf_guard') ?></h1>
</div>

<?php echo get_partial('sfGuardRegister/form', array('form' => $form , 'plan' => $plan)) ?>