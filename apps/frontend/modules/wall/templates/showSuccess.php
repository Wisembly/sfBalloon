<?php
$cans = array(
  'can_fav_quote' => can($sf_user, 'fav_quote', $wall),
  'can_validate_moderating_quote' => can($sf_user, 'validate_moderating_quote', $wall),
  'can_remove_quote' => can($sf_user, 'remove_quote', $wall),
  'can_update_moderating_quote' => can($sf_user, 'update_moderating_quote', $wall),
  'can_une_quote'  => can($sf_user, 'une_quote', $wall),
  'can_view_vote_quote' => can($sf_user, 'view_quote_nb_vote', $wall)
);
?>
<div class="conteneur_header">
  <?php include_partial('poster', 
    array('wallId' => $wallId, 'eventId' => $eventId, 'form' => $form, 'menu' => $menu)) ?>
</div>
<div id="wall">
  <?php if($moderatedQuotes->count() && $wall->isModerated() && can($sf_user, 'show_moderating_quotes', $wall)): ?>
    <h3>Quote Moderated</h3>
    <ul>
      <?php foreach($moderatedQuotes as $quote): ?>
        <li>
          <?php include_partial('quote/quote', array(
              'wall' => $wall, 
              'quote' => $quote, 
              'eventId' => $eventId
            ) + $cans); ?>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif;?>
  <?php if($publishedQuotes->count()): ?>
  <div class="entete">
    <h3>Quotes</h3>
  </div>
  <ul>
    <?php foreach($publishedQuotes as $quote): ?>
    <li>
      <div class="item_wall">
        <?php include_partial('quote/quote', array(
            'wall' => $wall, 
            'quote' => $quote, 
            'eventId' => $eventId
          ) + $cans); ?>
      </div>
      <div class="separation"></div>
    </li>
    <?php endforeach;?>
  </ul>
  <?php else: ?>
    <div id="newquotes">Pas encore de question posée. Soyez le premier à réagir!</div>
  <?php endif;?>
</div>
<div class="footer">
  <div id="menu_suivant">
    <a class="suivantes" href="#more"><div class="color4" id="suivantes">Load more questions</div></a>
  </div>
  <div id="copyright" class="color2">
      &nbsp;<a href="http://balloonup.com">Copyright &copy; 2010 Balloon, tous droits réserv&eacute;s</a>
  </div>
</div>