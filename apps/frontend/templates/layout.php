<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
    <?php echo stylesheet_tag('login') ?>

    <!-- pour signin-->
    <script type="text/javascript">$(document).ready(function(){$(".signin").click(function(e){e.preventDefault();$("fieldset#signin_menu").toggle();$(".signin").toggleClass("menu-open");});$("fieldset#signin_menu").mouseup(function(){return false});$(document).mouseup(function(e){if($(e.target).parent("a.signin").length==0){$(".signin").removeClass("menu-open");$("fieldset#signin_menu").hide();}});});</script>

  </head>
  <body>
  	<div class="header">
    	<a href=""><div class="logo"></div></a>
    </div>


    <div id="signin_container">
<div id="topnav" class="topnav">
    <a href="" class="signin">
        <span>
            <?php if($sf_user->isAuthenticated()): ?>
                <?php echo $sf_user->getUsername(); ?>
            <?php else:?>
                Identifiez-vous
            <?php endif;?>
        </span>
    </a>
</div>
<fieldset id="signin_menu">
<?php if($sf_user->isAuthenticated()): ?>
    <ul>
        <li><?php echo link_to("Se déconecter", "@sf_guard_signout"); ?></li>
        <li>Mon compte</li>
    </ul>
    <?php else:?>
    <ul>
        <li><?php echo link_to("Créer son compte", "@sf_guard_register")?></li>
        <li><?php echo link_to("S'identifier", "@sf_guard_signin")?></li>
        <li><?php echo link_to("Plans and Pricing", "@plans")?></li>
    </ul>
    <?php endif;?>
</fieldset>
</div>

    
    <div class="conteneur">
	      <div id="balloon">
	        <?php echo $sf_content ?>
	      </div>
      </div>
    
    
    
    <div class="powered">
    	<a href="http://balloonup.com#hec">Powered by 
    	<?php echo image_tag('logo_balloon_small.png'); ?>
    	</a>
    </div>
  </body>
</html>