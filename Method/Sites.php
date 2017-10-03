<?php
namespace GDO\WeChall\Method;
use GDO\Table\MethodQueryList;
use GDO\WeChall\WC_Site;
use GDO\WeChall\GDT\WC_SiteStatus;
use GDO\Type\GDT_Base;
use GDO\Template\GDT_Template;
use GDO\Core\Method;

final class Sites extends Method
{
    public function execute()
    {
        return $this->templatePHP('page/sites.php');
    }
}
