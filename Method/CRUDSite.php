<?php
namespace GDO\WeChall\Method;
use GDO\DB\GDO;
use GDO\Form\MethodCrud;
use GDO\WeChall\WC_Site;
use GDO\User\GDO_User;
use GDO\Template\Response;
use function foo\func;
use GDO\Template\GDT_Bar;
use GDO\UI\GDT_Link;

final class CRUDSite extends MethodCrud
{
    public function canCreate(GDO $table) { return GDO_User::current()->isStaff(); }
    public function canUpdate(GDO $gdo) { return $gdo->canUpdate(GDO_User::current()); }
    public function canDelete(GDO $gdo) { return false; }
    
    public function hrefList()
    {
        return href('WeChall', 'Sites');
    }

    public function gdoTable()
    {
        return WC_Site::table();
    }
    
    public function execute()
    {
        return parent::execute()->pre($this->renderBar());
    }

    public function renderBar()
    {
        if ($this->gdo)
        {
            $bar = GDT_Bar::make();
            $bar->addFields(array(
                GDT_Link::make('wc_site_admins')->href($this->gdo->href_site_admins()),
                GDT_Link::make('wc_site_descriptions')->href($this->gdo->href_site_descriptions()),
            ));
            return $bar->render();
        }
    }
    
    
}