<?php
use GDO\DB\GDT_Int;
$field instanceof GDT_Int;
?>
<input
 name="f[<?= $field->name; ?>]"
 type="text"
 pattern="^[-0-9]*$"
 value="<?= $field->displayFilterValue(); ?>"
 size="2" />
