<?php
namespace GDO\WeChall;
use GDO\Country\GDT_Country;
use GDO\DB\GDO;
use GDO\DB\GDT_AutoInc;
use GDO\WeChall\GDT\WC_SiteStatus;
use GDO\WeChall\GDT\WC_SiteName;
use GDO\Type\GDT_Name;
use GDO\Language\GDT_Language;
use GDO\Date\GDT_Date;
use GDO\Type\GDT_Secret;
use GDO\Net\GDT_Url;
use GDO\Type\GDT_String;
use GDO\Tag\WithTags;
use GDO\DB\Cache;
use GDO\DB\GDT_CreatedAt;
use GDO\File\GDT_File;
use GDO\DB\GDT_CreatedBy;
use GDO\DB\GDT_EditedAt;
use GDO\DB\GDT_EditedBy;
use GDO\Template\GDT_Template;
final class WC_Site extends GDO
{
    use WithTags;
    function gdoTagTable() { return WC_SiteTag::table(); }

    public function gdoColumns()
    {
        return array(
            GDT_AutoInc::make('site_id'),
            WC_SiteStatus::make('site_status')->notNull()->initial('wanted'),
            WC_SiteName::make('site_name')->notNull()->label('name'),
            GDT_Name::make('site_classname')->notNull()->unique()->label('classname'),
            
            GDT_File::make('site_logo')->imageFile()->label('logo'),
        
            GDT_Country::make('site_country'),
            GDT_Language::make('site_language')->notNull()->initial('en'),
            
            GDT_Date::make('site_launchdate'),
            GDT_Date::make('site_joindate'),
            
            GDT_Secret::make('site_authkey')->max(32),
            GDT_Secret::make('site_xauthkey')->max(32),
            
            GDT_String::make('site_irc'),
            
            GDT_Url::make('site_url'),
            GDT_String::make('site_url_mail'),
            GDT_String::make('site_url_score'),
            GDT_String::make('site_url_profile'),
            
            GDT_EditedAt::make('site_edited_at'),
            GDT_EditedBy::make('site_edited_by'),
            
            GDT_CreatedAt::make('site_created_at'),
            GDT_CreatedBy::make('site_created_by'),
        );
    }
    
    public function renderList() { return GDT_Template::php('WeChall', 'list/site.php', ['field' => $this]); }

    public function all()
    {
        if (false === ($cache = Cache::get('wc_all_sites')))
        {
            $cache = parent::all();
            Cache::set('wc_all_sites', $cache);
        }
        return $cache;
    }
    
    
}