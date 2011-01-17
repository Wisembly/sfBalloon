<div id="sf_admin_container">
	<h1>Ajouter un wall pour <?php echo $event->getName()?></h1>
	<div id="sf_admin_content">
    <?php include_partial('form', array('form' => $form, 'event' => $event)) ?>
	</div>
</div>