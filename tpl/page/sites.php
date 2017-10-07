<?php
use GDO\UI\GDT_Panel;
use GDO\UI\GDT_IconButton;
use GDO\WeChall\WC_Site;
use GDO\Table\GDT_Table;
use GDO\Core\GDT_Template;
use GDO\UI\GDT_EditButton;

$sites = WC_Site::table();

$table = GDT_Table::make();
$table->addFields(array(
    $sites->gdoColumn('site_id'),
    GDT_EditButton::make('edit_site'),
    $sites->gdoColumn('site_country'),
    $sites->gdoColumn('site_name'),
    GDT_Template::make()->template('WeChall', 'cell/site_diff.php'),
));

$table->query($sites->select()->joinObject('site_diff'));

echo $table->render();

echo GDT_IconButton::make()->href(href('WeChall', 'CRUDSite'))->icon('create')->render();

echo GDT_Panel::make()->html(t('wc_sites_about'))->render();
