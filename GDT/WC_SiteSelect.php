<?php
namespace GDO\WeChall\GDT;
use GDO\DB\GDT_ObjectSelect;
use GDO\WeChall\WC_Site;
use GDO\DB\ArrayResult;
use GDO\User\GDO_User;
/**
 * Site select.
 * @author gizmore
 */
final class WC_SiteSelect extends GDT_ObjectSelect
{
    public function __construct()
    {
        $this->table(WC_Site::table());
    }
    
    /**
     * @return WC_Site
     */
    public function getSite()
    {
        return $this->getValue();
    }
    
    const ALL = 0;
    const LINKED = 1;
    const LINKABLE = 2;
    public $mode = self::ALL;
    public function mode(int $mode) { $this->mode = $mode;  return $this; }
    public function onlyLinkable() { return $this->mode(self::LINKABLE); }
    
    public function initChoices()
    {
        if (!$this->choices)
        {
            $user = GDO_User::current();
            $choices = $this->table->all();
            switch ($this->mode)
            {
                case self::ALL:
                    break;
                case self::LINKABLE:
                    $keep = [];
                    foreach ($choices as $site)
                    {
                        /** @var $site \GDO\WeChall\WC_Site **/
                        if ($site->isUp() && (!$site->isSiteLinked($user)))
                        {
                            $keep[$site->getID()] = $site;
                        }
                    }
                    $choices = $keep;
                    break;
            }
            return $this->choices($choices);
        }
        return $this;
    }
    
    
}
