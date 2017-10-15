<?php /** @var $page \GDO\UI\GDT_Page **/
use GDO\Core\GDT_Template;
use GDO\Core\Module_Core;
use GDO\Core\Website;
use GDO\Util\Javascript;
?>
<!DOCTYPE html>
<html>
  <head>
    <? # Website::displayMeta(); ?>
    <?= Website::displayLink(); ?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="index, follow" />
  </head>
  <body>
    <?= GDT_Template::php('WeChall', 'layout/top_bar.php'); ?>
    <?= GDT_Template::php('WeChall', 'layout/top_menu.php'); ?>
	<div class="gdo-body">
	  <div class="gdo-main"><?= $page->html; ?></div>
	  <div class="gdo-right-bar"><?= GDT_Template::php('WeChall', 'layout/side_bar.php'); ?></div>
	</div>
    <?= GDT_Template::php('WeChall', 'layout/bottom_bar.php'); ?>
    <?= Javascript::displayJavascripts(Module_Core::instance()->cfgMinifyJS() === 'concat'); ?>
  </body>
</html>
