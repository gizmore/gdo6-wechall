<?php
namespace GDO\WeChall;

use GDO\Core\GDO;
use GDO\User\GDT_User;
use GDO\DB\GDT_Object;
use GDO\DB\GDT_CreatedAt;
use GDO\DB\GDT_String;
use GDO\DB\GDT_UInt;
use GDO\DB\GDT_Checkbox;
use GDO\DB\GDT_Decimal;
use GDO\User\GDO_User;
use GDO\DB\GDT_EditedAt;

/**
 * User registered at a site.
 * 
 * @author gizmore
 */
final class WC_RegAt extends GDO
{
    public static function getForId($userid, $siteid) { return self::getById($userid, $siteid); }
    public static function getFor(GDO_User $user, WC_Site $site) { return self::getById($user->getID(), $site->getID()); }
    public static function getByOnsitename(WC_Site $site, $onsitename) { return self::table()->select()->where("regat_site={$site->getID()} AND regat_onsitename=".GDO::quoteS($onsitename))->first()->exec()->fetchObject(); }
    
    public function gdoColumns()
    {
        return [
            GDT_User::make('regat_user')->primary(),
            GDT_Object::make('regat_site')->table(WC_Site::table())->primary(),
            
            GDT_String::make('regat_onsitename')->max(64)->notNull(),
            GDT_UInt::make('regat_onsitescore')->initial('0'),
            GDT_UInt::make('regat_onsiterank'),
            GDT_UInt::make('regat_challsolved')->bytes(2),

            GDT_Checkbox::make('regat_scored')->initial('1'),
            GDT_Checkbox::make('regat_hidename')->initial('0'),
            GDT_UInt::make('regat_score')->initial('0'),
            GDT_Decimal::make('regat_solved')->initial('0')->digits(1, 4),
            
            GDT_EditedAt::make('regat_lastdate'),
            GDT_CreatedAt::make('regat_linkdate'),
        ];
    }
    
    public function isNicknameHidden() { return $this->getVar('regat_hidename'); }
    
}
