<?php 
use GDO\DB\GDT_String;
$field instanceof GDT_String;
?>
<input
 name="f[<?= $field->name?>]"
 type="text"
 size="<?= min($field->max, 20); ?>"
 value="<?= $field->displayFilterValue(); ?>" />
