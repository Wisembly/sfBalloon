<?php if(!$isAllowed): ?>
  <form action="<?php echo url_for('@event?short='.$event->getShort()) ?>" method="POST"> 
    <?php echo $form->renderGlobalErrors();?>  
    <?php echo $form->renderHiddenFields(); ?>
    Mot de passe : 
    <?php foreach($form as $f):?>
      <?php echo $f->renderError();?>
      <?php echo $f; ?>
    <?php endforeach;?>
      <input type="submit" value="Envoyer">  
  </form>
<?php else: ?>

  <div id="place_content">
    <div id="admin_edit_event">
      <?php echo link_to('Ajouter un wall',sprintf('@event_add_wall?short=%s', $event->getShort())); ?>
    </div>
    <div id="admin_event_members">
      <?php echo link_to('Gérer les Utilisateurs',sprintf('@invitation?event=%s', $event->getShort())); ?>
    </div>
    <div id="admin_edit_event">
      <?php echo link_to("Modifier l'événement ".$event->getName(),sprintf('@event_edit?short=%s', $event->getShort())); ?>
    </div>
    
    <br />
  
    <div id="place_1" class="place_edit">
      <h2><?php echo $event->getName(); ?></h2>
    </div>
    <br />
    <div class="description">
        <div id="title"><div class="green-button"></div><span>Description :</span><br/></div>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
        Integer tempor, felis non facilisis lacinia, eros leo facilisis mi,
        in interdum ipsum ligula vitae mi. In consectetur, velit a viverra fringilla,
        eros eros tristique elit, sit amet convallis arcu enim et nunc. Nullam nec lectus eros,
        id adipiscing neque. Integer imperdiet velit id ipsum placerat laoreet. Quisque in turpis ante,
        ac posuere enim. Sed pretium interdum dolor, non pulvinar ante auctor vel.
        Quisque laoreet felis ut augue molestie ultrices gravida dui venenatis.
        Fusce mattis, velit vel elementum dignissim, leo nisl facilisis augue,
        ultrices sagittis mi tortor vel tortor. Vestibulum pellentesque,
        est vel malesuada porttitor, sem nisi tincidunt mauris, nec dignissim velit augue ac metus.
        Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
        Pellentesque eu dolor magna. Aliquam tincidunt tempus nunc, non fermentum sapien porttitor ut.
        Quisque sodales porttitor congue. Mauris ornare arcu at dolor egestas aliquet.
        Nam blandit eleifend velit a molestie. Maecenas eleifend rutrum eleifend.
        Aenean in neque quis neque lobortis cursus eu in tortor.
    </div>
    <ul id="events">
        <li id="title">
            <div class="green-button"></div>
            <span>Aujourd'hui :</span>
            <div class="clear"></div>
        </li>
      <?php foreach($event->getWalls() as $wall):?>
        <?php if($wall->isAvailable()): ?>
        <li id="wall">
            <div class="admin_buttons_list_wall">
                <div class="label-list-wall">
                    <?php echo link_to($wall->getName(), sprintf('@wall?event=%s&wall=%s', $event->getShort(), $wall->getShort()) ); ?>
                </div>
                <div class="label-description">
                    Lundi 25 avril 2011 au Mercredi 27 avril 2011 à Paris
                </div>
                
                <?php if(can($sf_user, 'update', $wall)): ?>
                <div class="button-action">
                    <a href="#" >Supprimer</a> -
                    <?php echo link_to('Editer',sprintf('@wall_edit?event=%s&wall=%s', $event->getShort(), $wall->getShort())); ?> - 
                    <a href="#" >Stats (ßeta)</a>
                </div>
                <?php endif;?>
                
            </div>
            <div class="clear"></div>
        </li> 
        <?php endif;?>
      <?php endforeach; ?>
    </ul>
    <br />
    
    <?php if(can($sf_user, 'view_archive', $event)): ?>
    <div class="archives">
        <div id="title"><div class="green-button"></div><span>Archives :</span><br/></div>
    </div>
    <ul id="past-events">
      <?php foreach($event->getWalls() as $wall):?>
        <?php if(!$wall->isAvailable()): ?>
        <li>
          <?php echo link_to($wall->getName(), sprintf('@wall?event=%s&wall=%s', $event->getShort(), $wall->getShort()) ); ?>  
        </li> 
        <?php endif;?>
      <?php endforeach; ?>
    </ul>
    <?php endif;?>
  </div>  
<?php endif; ?>