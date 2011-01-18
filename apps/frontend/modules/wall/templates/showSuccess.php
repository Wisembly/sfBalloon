<h3>Votre question</h3>
<p>
  <form action="<?php echo url_for(sprintf("@quote_create?event=%s&wall=%s", $eventId, $wallId)); ?>" method="post">
    <?php echo $form;?>
    <p><input type="submit" value="Envoyer"></p>
  </form>
</p>

<h3>Liste</h3>

<ul>
  <?php foreach($wall->getQuotes() as $quote): ?>
  <li><?php echo $quote->getQuote();?> - <?php echo distance_of_time_in_words(strtotime($quote->getCreatedAt())); ?></li>
  <?php endforeach;?>
</ul>