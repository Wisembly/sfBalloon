<h3>Editer l'event</h3>
<p>
  <form action="<?php echo url_for(sprintf("@event_edit?short=%s", $event->getShort())); ?>" enctype="multipart/form-data" method="post">
    <?php echo $form;?>
    <p><input type="submit" value="Modifier"></p>
  </form>
</p>
