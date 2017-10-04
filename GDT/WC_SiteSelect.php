<?php
namespace GDO\WeChall\GDT;
use GDO\DB\GDT_ObjectSelect;
use GDO\WeChall\WC_Site;
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
    
}
