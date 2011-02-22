<div class="conteneur_header">
  <div id="poster">
    <div id="entete"><p>Votre question</p></div>
    <div id="compteur">140</div>
      <form action="<?php echo url_for(sprintf("@quote_create?event=%s&wall=%s", $eventId, $wallId)); ?>" method="post">
        <div id="textarea"><?php echo $form;?></div>
        <div id="bt_send"><input type="submit" value="Envoyer" class="envoyer"></div>
      </form>
  </div>
  <div class="clear"></div>
    <div id="menu">
      <ul>
          <li class="active">
            <?php echo link_to('Dernières', url_for(sprintf("@wall?event=%s&wall=%s", $eventId, $wallId)));?>
          </li>
          <li>
            <?php echo link_to('Populaires', 
              url_for(sprintf("@wall?event=%s&wall=%s&sort=top", $eventId, $wallId)));?>
          </li>
          <li><a href="">Réponses</a></li>
        </ul>
    </div>
</div>
<div id="wall">
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
      <div class="item_wall">
        <?php include_partial('quote/quote', array('wall' => $wall, 'quote' => $quote, 'eventId' => $eventId)); ?>
      </div>
      <div class="separation"></div>
    </li>
    <?php endforeach;?>
  </ul>

</div>
<div class="footer">
  <div id="menu_suivant">
    <a class="suivantes" href="#more"><div class="color4" id="suivantes">Load more questions</div></a>
  </div>
  <div id="copyright" class="color2">
    <a href="http://balloonup.com">Copyright &copy; 2010 Balloon, tous droits réserv&eacute;s</a>
  </div>
</div>