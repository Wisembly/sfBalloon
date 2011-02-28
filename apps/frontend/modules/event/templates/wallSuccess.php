<form action="<?php echo url_for(sprintf("@event_add_wall?short=%s", $event->getShort())); ?>" method="post">
	<?php echo $form; ?>
	<input type="submit" value="Envoyer">  
</form>