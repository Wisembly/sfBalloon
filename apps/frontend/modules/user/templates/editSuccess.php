<?php use_helper('I18N') ?>
<h1>Mon compte</h1>

<form action="<?php echo url_for('@user_edit') ?>" method="post">
  <table>
    <?php echo $form ?>
    <tfoot>
      <tr>
        <td colspan="2">
          <input type="submit" name="register" value="<?php echo __('Mettre à jour', null, 'sf_guard') ?>" />
        </td>
      </tr>
    </tfoot>
  </table>
</form>