<?php
use GDO\Perf\GDT_PerfBar;
use GDO\Core\GDT_Template;
?>
<footer>
  <?= GDT_Template::php('WeChall', 'layout/bottom_menu.php'); ?>
  <?= GDT_PerfBar::make(); ?>
</footer>
