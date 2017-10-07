<?php
use GDO\DB\GDT_Checkbox;
$field instanceof GDT_Checkbox;
$val = $field->filterValue();
?>
<select name="f[<?= $field->name ?>]">
<option value="" <?= $val === '' ? 'selected="selected"' : ''; ?>>All</option>
<option value="1" <?= $val === '1' ? 'selected="selected"' : ''; ?>>Checked</option>
<option value="0" <?= $val === '0' ? 'selected="selected"' : ''; ?>>Unchecked</option>
</select>
