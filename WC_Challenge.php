<?php
namespace GDO\WeChall;
use GDO\Core\GDO;
use GDO\DB\GDT_AutoInc;
use GDO\DB\GDT_Name;
use GDO\UI\GDT_Title;
use GDO\Net\GDT_Url;
use GDO\DB\GDT_Join;
class WC_Challenge extends GDO
{
    public function gdoColumns()
    {
        return array(
            GDT_AutoInc::make('chall_id'),
            GDT_Name::make('chall_name'),
            GDT_Title::make('chall_title'),
            GDT_Url::make('chall_url'),
            GDT_Join::make('chall_diff')->join('wc_challdiff cd ON cd.challdiff_chall = chall_id'),
        );
    }
    
}
