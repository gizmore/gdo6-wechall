<?php
namespace GDO\WeChall\GDT;
use GDO\UI\GDT_Icon;
use GDO\Util\Math;
final class WC_SiteLogo extends GDT_Icon
{
    public function solved(int $solved=10000)
    {
        return $this->size(Math::clamp($solved*16/10000, 3, 16));
    }
}