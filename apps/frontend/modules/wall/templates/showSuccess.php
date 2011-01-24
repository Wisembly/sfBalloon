<h3>Votre question</h3>
<p>
  <form action="<?php echo url_for(sprintf("@quote_create?event=%s&wall=%s", $eventId, $wallId)); ?>" method="post">
    <?php echo $form;?>
    <p><input type="submit" value="Envoyer"></p>
  </form>
</p>


<?php if($wall->isModerated()): ?>
  <h3>Quote Moderated</h3>
  <ul>
    <?php foreach($moderatedQuotes as $quote): ?>
      <li>
        <?php echo $quote->getQuote();?> - 
        <?php echo distance_of_time_in_words(strtotime($quote->getCreatedAt())); ?> - 
      </li>
    <?php endforeach; ?>
  </ul>
<?php endif;?>
<h3>Quotes</h3>
<ul>
  <?php foreach($publishedQuotes as $quote): ?>
  <li>
    <?php echo $quote->getQuote();?> - 
    <?php echo distance_of_time_in_words(strtotime($quote->getCreatedAt())); ?> - 
    <?php echo link_to('Vote', sprintf('@quote_vote?event=%s&wall=%s&quote=%s', $eventId, $wallId, $quote->getId()))?> 
    (<?php echo $quote->getVotesCount()?>)
  </li>
  <?php endforeach;?>
</ul>