<h3>Editer l'event</h3>
<p>
  <form action="<?php echo url_for(sprintf("@wall_edit?event=%s&wall=%s", $eventId, $wallId)); ?>" enctype="multipart/form-data" method="post">
    <?php echo $form;?>
    <p><input type="submit" value="Modifier"></p>
  </form>
</p>
