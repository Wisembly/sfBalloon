<h3>Editer la question</h3>
<p>
  <form action="<?php echo url_for(sprintf("@quote_edit?event=%s&wall=%s&quote=%s", $eventId, $wallId, $quoteId)); ?>" method="post">
    <?php echo $form;?>
    <p><input type="submit" value="Modifier"></p>
  </form>
</p>
