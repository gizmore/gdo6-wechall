<?php
use GDO\Type\GDT_String;
$field instanceof GDT_String;
?>
<div class="gdo-container<?= $field->classError(); ?>">
  <?= $field->icon; ?>
  <label for="form[<?= $field->name; ?>]"><?= $field->label; ?></label>
  <input
   type="text"
   <?= $field->htmlRequired(); ?>
   <?= $field->htmlPattern(); ?>
   <?= $field->htmlDisabled(); ?>
   min="<?= $field->min; ?>"
   max="<?= $field->max; ?>"
   size="<?= min($field->max, 32); ?>"
   name="form[<?= $field->name; ?>]"
   value="<?= $field->getVar(); ?>" />
  <div class="gdo-form-error"><?= $field->error; ?></div>
</div>
