<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
    <div id="content">
      <h1>VotreQuestion.com</h1>
      <div id="user">
        <?php if($sf_user->isAuthenticated()): ?>
          Hello <?php echo $sf_user->getUsername(); ?> - 
          <?php echo link_to("Logout", "@sf_guard_signout"); ?>
        <?php else:?>
          <?php echo link_to("Créer son compte", "@sf_guard_register")?> - 
          <?php echo link_to("Login", "@sf_guard_signin")?> - 
          <?php echo link_to("Plans and Pricing", "@plans")?>
        <?php endif;?>
      </div>
      <?php if($sf_user->isAuthenticated() && $sf_user->isRoot()): ?>
      <div id="actions">
        <ul>
          <li><?php echo link_to("Ajouter un event", "@event_new")?></li>
        </ul>
      </div>
      <?php endif; ?>
      <div id="balloon">
        <?php echo $sf_content ?>
      </div>
    </div>
  </body>
</html>
