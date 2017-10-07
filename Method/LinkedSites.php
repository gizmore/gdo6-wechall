<?php
namespace GDO\WeChall\Method;
use GDO\UI\MethodPage;
use GDO\Util\Common;
use GDO\WeChall\WC_Site;
use GDO\WeChall\WC_RegAt;
use GDO\User\GDO_User;
final class LinkedSites extends MethodPage
{
    public function execute()
    {
        if (isset($_GET['update']))
        {
            return $this->onUpdate(Common::getGetString('site'))->add(parent::execute());
        }
        return parent::execute();
    }
    
    public function onUpdate($siteid)
    {
        if (!($site = WC_Site::getById($siteid)))
        {
            return $this->error('err_site');
        }
        
        if (!($regat = WC_RegAt::getFor(GDO_User::current(), $site)))
        {
            return $$this->error('err_site_not_linked', [$site->displayName()]);
        }
        
        return $this->onUpdateRegat($regat);
    }
        
    public function onUpdateRegat(WC_RegAt $regat)
    {
        
    }
    
}
