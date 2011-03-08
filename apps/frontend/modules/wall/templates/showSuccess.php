<?php if(can($sf_user, 'update', $wall)): ?>
  <?php echo link_to('Editer ce wall',sprintf('@wall_edit?event=%s&wall=%s', $event->getShort(), $wall->getShort())); ?>
<?php endif;?>
<div class="conteneur_header">
  <?php include_partial('wall/poster', 
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
              'eventId' => $eventId,
              'moderated' => true
            ) + $cans->getRawValue()); ?>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif;?>
  <?php $result = $pager->getResults();?>
  <?php if($result->count()): ?>
  <div class="entete">
    <h3>Quotes</h3>
  </div>
  <ul>
    <?php foreach($result as $quote): ?>
    <li>
      <div class="item_wall">
        <?php include_partial('quote/quote', array(
            'votes'   => $currentUserVotes,
            'wall'    => $wall, 
            'quote'   => $quote, 
            'eventId' => $eventId
          ) + $cans->getRawValue()); ?>
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
  <!-- <div id="menu_suivant">
      <a class="suivantes" href="#more"><div class="color4" id="suivantes">Load more questions</div></a>
    </div> -->
    
    <?php if ($pager->haveToPaginate()): ?>
    <div class="pagination">
        <?php include_partial('paginate', array(
          'pager' => $pager, 
          'route' => url_for(sprintf('@wall?event=%s&wall=%s', $eventId, $wallId)
        ))) ?>
    </div>
    <?php endif ?>
  <div id="copyright" class="color2">
      &nbsp;<a href="http://balloonup.com">Copyright &copy; 2010 Balloon, tous droits réserv&eacute;s</a>
  </div>
</div>