<?php
namespace GDO\WeChall\GDT;
use GDO\Type\GDT_String;

final class WC_SiteName extends GDT_String
{
    public function __construct()
    {
        $this->min(2)->max(32);
        $this->caseS()->utf8();
    }
}