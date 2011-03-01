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
  <div id="poster">
    <div id="compteur">140</div>
      <form action="<?php echo url_for(sprintf("@quote_create?event=%s&wall=%s", $eventId, $wallId)); ?>" method="post">
        <div id="textarea">
            <?php $cp = 0;?>
            <?php foreach ($form as $field): ?>
                <?php if(!$field->isHidden()):?>
                        <?php if($cp == 1):?>
                            <?php echo '<strong>'.$field->renderLabel().'</strong>'; ?>
                            <?php echo $field->render(); ?>
                            <?php if($field->renderError()) { echo '<p>'.$field->renderError()."</p>"; }?>
                        <?php endif ?>
                        <?php if($cp == 2):?>
                            <div class="poll-duration">
                            <?php echo $field->renderLabel(); ?>
                            <?php echo $field->render(); ?>
                            <?php if($field->renderError()) { echo '<p>'.$field->renderError()."</p>"; }?>
                            </div>
                        <?php endif ?>
                        <?php if($cp >= 3):?>
                            <div class="poll">
                                <?php echo $field->renderLabel();?>
                            <?php foreach($field as $poll) :?>
                                <?php foreach($poll as $poll_field) :?>
                                    <?php echo $poll_field->render(); ?>
                                <?php endforeach ?>
                            <?php endforeach ?>
                            </div>
                        <?php endif ?>
                <?php else: ?>
                    <?php echo $field->render();?>
                <?php endif ?>
                <?php $cp++;?>
            <?php endforeach ?>
        </div>
        <div id="bt_send"><input type="submit" value="Envoyer" class="envoyer"></div>
      </form>
  </div>
  <div class="clear"></div>
    <div id="menu">
      <?php echo $menu->render(); ?>
    </div>
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