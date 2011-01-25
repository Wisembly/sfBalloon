<h3>Editer la réponse "<?php echo $answer->getAnswer();?>"</h3>
<p>
  <form action="<?php echo url_for(sprintf('@answer_edit?event=%s&wall=%s&quote=%s&answer=%d', $eventId, $wallId, $quoteId, $answer->getId())); ?>" method="post">
    <?php echo $form;?>
    <p><input type="submit" value="Modifier"></p>
  </form>
</p>
