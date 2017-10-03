<?php
namespace GDO\WeChall\GDT;
use GDO\Form\GDT_Enum;

final class WC_SiteStatus extends GDT_Enum
{
    public function __construct()
    {
        $this->enumValues('up','down','dead','wanted','refused','contacted','coming_soon');
    }
}