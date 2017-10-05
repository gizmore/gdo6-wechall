<?php
namespace GDO\WeChall\Method;

use GDO\GWF\MethodAjax;
use GDO\User\GDO_User;
use GDO\Util\Common;
use GDO\WeChall\WC_Site;

final class WCAPIMail extends MethodAjax
{
    public function execute()
    {
        $wechall = WC_Site::getWeChall();
        
        
        $result = GDO_User::getByName(Common::getGetString('user'))
        die($result);
    }
}
