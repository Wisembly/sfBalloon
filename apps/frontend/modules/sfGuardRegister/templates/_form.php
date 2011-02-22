<?php use_helper('I18N') ?>

<form action="<?php echo url_for('@sf_guard_register?plan='.$plan) ?>" method="post">
  <div class="sign_table">
      <table class="tab-center">
          <tr>
              <td>
      <table>
        <?php $compteur = 0; ?>
    <?php foreach ($form as $field): ?>
        <?php if(strpos($field->render(),'hidden')== false):?>
            <tr class="field">
                <th><?php echo $field->renderLabel(); ?></th>
                <td><?php echo $field->render(); ?></td>
                <td class="error"><?php echo $field->renderError(); ?><td>
            </tr>
            <?php if($compteur == 2) echo'</table></td><td><table>';?>
            <?php $compteur++;?>
        <?php endif ?>
    <?php endforeach ?>
</table></tr></table>
  <table class="tab-center">
      <tr>
        <td colspan="3" align="center">
          <input class="register" type="submit" name="register" value="<?php echo __('Register', null, 'sf_guard') ?>" />
        </td>
      </tr>
  </table>
 </div>
</form>
<br/>