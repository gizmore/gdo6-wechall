<?php
namespace GDO\WeChall\GDT;
use GDO\Template\GDT_Bar;
use GDO\User\GDO_User;
final class WC_RightBar extends GDT_Bar
{
    public $direction = self::VERTICAL;
    
    public function __construct()
    {
        $this->user(GDO_User::current());
    }
    
    public function user(GDO_User $user)
    {
        if ($user->isGhost())
        {
            $this->addField(WC_SideLogin::make());
        }
        
    }
}
