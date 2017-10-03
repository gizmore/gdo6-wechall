<?php
use GDO\Core\Website;
use GDO\Util\Javascript;
use GDO\Template\GDT_Bar;
use GDO\GWF\Module_GWF;
use GDO\Template\GDT_Template;
$page instanceof GDO\UI\GDT_Page;
?>
<!DOCTYPE html>
<html>
  <head>
    <? # Website::displayMeta(); ?>
    <? # Website::displayLink(); ?>
    <link href="GDO/Core/thm/default/css/gdo6.css" rel="stylesheet" />
    <link href="GDO/GWF/thm/classic/css/gdo6-classic.css" rel="stylesheet" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="index, follow" />
  </head>
  <body>
    <?= GDT_Template::php('WeChall', 'top_bar.php'); ?>
    <?= GDT_Template::php('WeChall', 'top_menu.php'); ?>
	<div class="gdo-body">
	  <main><?= $page->html; ?></main>
      <?= GDT_Template::php('WeChall', 'side_bar.php'); ?>
	</div>
    <?= GDT_Template::php('WeChall', 'bottom_bar.php'); ?>
    <?# Javascript::displayJavascripts(Module_GWF::instance()->cfgMinifyJS() === 'concat'); ?>
  </body>
</html>
