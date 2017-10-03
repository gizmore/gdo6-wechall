<?php
namespace GDO\WeChall;
use GDO\Tag\GDO_TagTable;
final class WC_SiteTag extends GDO_TagTable
{
    public function gdoTagObjectTable() { return WC_Site::table(); }
}
