<?php
use GDO\User\GDO_User;
use GDO\WeChall\WC_RegAt;
use GDO\Table\GDT_Table;
use GDO\WeChall\WC_Site;
use GDO\WeChall\GDT\WC_RegAtNickButton;
use GDO\UI\GDT_Button;
use GDO\Form\GDT_Form;
use GDO\Form\GDT_Submit;
use GDO\Form\GDT_AntiCSRF;
$user = GDO_User::current();
$userid = $user->getID();

# LinkForm
echo GDT_Button::make('menu_link_site')->href(href('WeChall', 'LinkSite'));

# RegAt table
$sites = WC_Site::table();
$regats = WC_RegAt::table();
$table = GDT_Table::make();
$table->addHeaders(array(
    $sites->gdoColumn('site_name'),
    $regats->gdoColumn('regat_challsolved'),
    $sites->gdoColumn('site_challcount'),
    $sites->gdoColumn('site_autoupdate'),
    GDT_Button::make('wc_linked_site_update'),
    $regats->gdoColumn('regat_score'),
    $regats->gdoColumn('regat_solved'),
    $regats->gdoColumn('regat_lastdate'),
    $regats->gdoColumn('regat_onsitename'),
    WC_RegAtNickButton::make(),
    GDT_Button::make('wc_unlink_site'),
));
$table->query($regats->select()->where("regat_user={$userid}")->joinObject('regat_site'));
$table->ordered(true, 'regat_linkdate');
echo $table;

# Update all
$form = GDT_Form::make();
$form->addFields(array(
    GDT_AntiCSRF::make(),
));
$form->actions()->addField(GDT_Submit::make()->label('btn_update_all_sites'));

echo $form;
