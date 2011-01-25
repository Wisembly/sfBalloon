<h3><?php echo $quote->getQuote(); ?></h3>

<?php if(can($sf_user, 'answer_quote', $wall)): ?>
<h4>Ajouter une réponse</h4>
<p>
  <form action="<?php echo url_for(sprintf("@answer_create?event=%s&wall=%s&quote=%s", $eventId, $wallId, $quoteId)); ?>" method="post">
    <?php echo $form;?>
    <p><input type="submit" value="Modifier"></p>
  </form>
</p>

<?php endif;?>

<h4>Réponses</h4>
<ul>
<?php foreach($quote->getAnswers() as $answer): ?>
  <li>
    <?php echo $answer->getAnswer()?> - 
    <?php echo link_to('Delete', sprintf('@answer_delete?event=%s&wall=%s&quote=%s&answer=%d', $eventId, $wallId, $quoteId, $answer->getId()), array('method' => 'delete', 'confirm' => 'Are you sure')); ?>
  </li>
<?php endforeach; ?>
</ul>