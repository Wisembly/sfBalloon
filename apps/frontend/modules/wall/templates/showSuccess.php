<h3>Votre question</h3>
<p>
  <form action="<?php echo url_for(sprintf("@quote_create?event=%s&wall=%s", $event, $wall)); ?>" method="post">
    <?php echo $form;?>
    <p><input type="submit" value="Envoyer"></p>
  </form>
</p>

<h3>Liste</h3>

<ul>
  <?php foreach($quotes as $quote): ?>
  <li><?php echo $quote->getQuote();?></li>
  <?php endforeach;?>
</ul>