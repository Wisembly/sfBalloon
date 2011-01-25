<h3>Votre question</h3>
<p>
  <form action="<?php echo url_for(sprintf("@quote_create?event=%s&wall=%s", $eventId, $wallId)); ?>" method="post">
    <?php echo $form;?>
    <p><input type="submit" value="Envoyer"></p>
  </form>
</p>


<?php if($wall->isModerated() && can($sf_user, 'show_moderating_quote', $wall)): ?>
  <h3>Quote Moderated</h3>
  <ul>
    <?php foreach($moderatedQuotes as $quote): ?>
      <li>
        <?php include_partial('quote/quote', array('wall' => $wall, 'quote' => $quote, 'eventId' => $eventId)); ?>
      </li>
    <?php endforeach; ?>
  </ul>
<?php endif;?>
<h3>Quotes</h3>
<ul>
  <?php foreach($publishedQuotes as $quote): ?>
  <li>
    <?php include_partial('quote/quote', array('wall' => $wall, 'quote' => $quote, 'eventId' => $eventId)); ?>
  </li>
  <?php endforeach;?>
</ul>