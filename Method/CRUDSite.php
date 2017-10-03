<?php
namespace GDO\WeChall\Method;
use GDO\Form\MethodCrud;
use GDO\WeChall\WC_Site;

final class CRUDSite extends MethodCrud
{
    public function hrefList()
    {
        return href('WeChall', 'Sites');
    }

    public function gdoTable()
    {
        return WC_Site::table();
    }
    
}