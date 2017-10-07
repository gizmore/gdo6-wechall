<?php
namespace GDO\WeChall\Method;
use GDO\Table\MethodQueryTable;
use GDO\WeChall\WC_Site;
use GDO\WeChall\WC_SiteAdmin;
use GDO\Util\Common;
use GDO\User\GDO_User;
use GDO\UI\GDT_Button;
final class SiteAdmins extends MethodQueryTable
{
    /**
     * @var WC_Site
     */
    private $site;
    
    public function isGuestAllowed() { return false; }
    
    public function execute()
    {
        $this->site = WC_Site::table()->find(Common::getGetInt('id'));
        return parent::execute();
    }
    
    public function getQuery()
    {
        # Fetch from siteadmin as user objects
        $query = WC_SiteAdmin::table()->select('*, wc_siteadmin.*')->joinObject('sitemin_user')->fetchTable(GDO_User::table());
        # For one site
        return $query->where("sitemin_site={$this->site->getID()}");
    }
    
    public function getHeaders()
    {
        $users = GDO_User::table();
        $sitem = WC_SiteAdmin::table();
        return array(
            $sitem->gdoColumn('sitemin_user'),
            $sitem->gdoColumn('sitemin_created'),
            $sitem->gdoColumn('sitemin_creator'),
            GDT_Button::make('sitemin_delete'),
        );
    }


    
}
