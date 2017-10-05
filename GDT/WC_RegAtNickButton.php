<?php
namespace GDO\WeChall\GDT;
use GDO\UI\GDT_Button;
use GDO\WeChall\WC_RegAt;
/**
 * Show one or the other button depending on state.
 * @author gizmore
 */
final class WC_RegAtNickButton extends GDT_Button
{
    /**
     * @return WC_RegAt
     */
    public function regat()
    {
        return $this->gdo;
    }
    
    public function renderCell()
    {
        if ($this->regat()->isNicknameHidden())
        {
            $this->name = 'wc_regat_nick_show';
        }
        else
        {
            $this->name = 'wc_regat_nick_hide';
        }
        return parent::renderCell();
    }
}
