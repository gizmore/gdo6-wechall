<?php
use GDO\Template\GDT_Panel;
use GDO\UI\GDT_IconButton;
use GDO\WeChall\WC_Site;
use GDO\Table\GDT_Table;
use GDO\Vote\GDT_VoteSelection;
use GDO\WeChall\WC_SiteDiff;
use GDO\Type\GDT_Decimal;
use GDO\Template\GDT_Template;

$sites = WC_Site::table();

$table = GDT_Table::make();
$table->addFields(array(
    $sites->gdoColumn('site_id'),
    $sites->gdoColumn('site_country'),
    $sites->gdoColumn('site_name'),
    GDT_Template::make()->template('WeChall', 'cell/site_diff.php'),
));

$table->query($sites->select()->joinObject('site_diff'));

echo $table->renderCell();

echo GDT_IconButton::make()->href(href('WeChall', 'CRUDSite'))->icon('create');

echo GDT_Panel::make()->html(t('wc_sites_about'));
