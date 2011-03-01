<?php
$cans = array(
  'can_fav_quote' => can($sf_user, 'fav_quote', $wall),
  'can_validate_moderating_quote' => can($sf_user, 'validate_moderating_quote', $wall),
  'can_remove_quote' => can($sf_user, 'remove_quote', $wall),
  'can_update_moderating_quote' => can($sf_user, 'update_moderating_quote', $wall),
  'can_une_quote'  => can($sf_user, 'une_quote', $wall)
);
?>
<div class="conteneur_header">
  <?php include_partial('poster', 
    array('wallId' => $wallId, 'eventId' => $eventId, 'form' => $form, 'menu' => $menu)) ?>
</div>
<div id="wall">
  <?php if($quotes->count()): ?>
  <div class="entete">
    <h3>Quotes en favori</h3>
  </div>
  <ul>
    <?php foreach($quotes as $quote): ?>
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
    <div id="newquotes">Pas encore de question en favori.</div>
  <?php endif;?>
</div>