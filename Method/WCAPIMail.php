<?php
namespace GDO\WeChall\Method;
use GDO\Core\MethodAjax;
use GDO\WeChall\WC_Site;
use GDO\User\GDO_User;
use GDO\Core\GDO;
use GDO\Util\Common;
/**
 * Own implementation of the WeChall API.
 * The mail part checks if an account exists.
 * We also use %AUTHKEY% to prevent enumeration. 
 * @author gizmore
 * @version 7.00
 * @since 1.00
 */
final class WCAPIMail extends MethodAjax
{
    public function execute()
    {
        if ($this->checkAuthKey(Common::getRequestString('authkey')))
        {
            $onsitename = GDO::quoteS(Common::getRequestString('user'));
            $onsitemail = GDO::quoteS(Common::getRequestString('email'));
            if (GDO_User::table()->select('1')->where("user_name=$onsitename AND user_email=$onsitemail AND user_deleted_at IS NULL")->exec()->fetchValue())
            {
                die('1');
            }
        }
        die('0');
    }
    
    public function checkAuthKey($authkey)
    {
        return WC_Site::getWeChall()->getVar('site_authkey') === $authkey;
    }
}
