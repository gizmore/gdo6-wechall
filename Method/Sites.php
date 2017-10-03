<?php
namespace GDO\WeChall\Method;
use GDO\Table\MethodQueryList;
use GDO\WeChall\WC_Site;
use GDO\WeChall\GDT\WC_SiteStatus;
use GDO\Type\GDT_Base;
use GDO\Template\GDT_Template;

final class Sites extends MethodQueryList
{
    /**
     * Page and status filter
     * {@inheritDoc}
     * @see \GDO\Table\MethodQueryList::gdoParameters()
     */
    public function gdoParameters()
    {
        return array_merge(parent::gdoParameters(), array(
            WC_SiteStatus::make('status'),
        ));
    }
    
    public function gdoTable() { return WC_Site::table(); }
//     public function gdoQuery() NOT needed because filterable table with gdoParameters Oo.... fck
//     {
//         $states = $this->gdoParameterVar('status');
//         return $this->gdoTable()->select()->where("site_status IN {$states}");
//     }

    public function renderPage()
    {
        return parent::renderPage()->add($this->templatePHP('page/sites_bottom.php'));
    }
    
}
