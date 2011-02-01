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
        	<li class="active"><a href="">Last</a></li>
            <li><a href="">Popular</a></li>
            <li><a href="">Answers</a></li>
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