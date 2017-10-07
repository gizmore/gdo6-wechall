<?php
namespace GDO\WeChall;
use GDO\Core\GDO;
use GDO\DB\GDT_CreatedAt;
use GDO\DB\GDT_CreatedBy;
use GDO\DB\GDT_Object;
use GDO\User\GDT_User;
/**
 * Siteadmin entry
 * @author gizmore
 */
final class WC_SiteAdmin extends GDO
{
    public function gdoColumns()
    {
        return array(
            GDT_User::make('sitemin_user'),
            GDT_Object::make('sitemin_site')->table(WC_Site::table()),
            GDT_CreatedAt::make('sitemin_created'),
            GDT_CreatedBy::make('sitemin_creator'),
        );
    }
    
}
