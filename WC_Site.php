<?php
namespace GDO\WeChall;
use GDO\Country\GDT_Country;
use GDO\Core\GDO;
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
use GDO\DB\GDT_Join;
use GDO\UI\GDT_Color;
use GDO\Type\GDT_UInt;
use GDO\Type\GDT_Decimal;
use GDO\Type\GDT_Checkbox;
use GDO\WeChall\GDT\WC_SiteLogo;
use GDO\User\GDO_User;
use GDO\Tag\GDT_Tags;
final class WC_Site extends GDO
{
    ############
    ### Tags ###
    ############
    use WithTags;
    function gdoTagTable() { return WC_SiteTag::table(); }

    ###############
    ### Factory ###
    ###############
    public static function getWeChall() { return self::getById('1'); }
    
    ###########
    ### GDO ###
    ###########
    public function gdoColumns()
    {
        return array(
            GDT_AutoInc::make('site_id'),
            WC_SiteStatus::make('site_status')->notNull()->initial('wanted'),
            WC_SiteName::make('site_name')->notNull()->label('name'),
            GDT_Name::make('site_classname')->notNull()->unique()->label('classname'),
            
            GDT_Color::make('site_color')->notNull(),
            GDT_File::make('site_logo')->imageFile()->label('logo'),
        
            GDT_Country::make('site_country')->emptyLabel(t('choose_site_country')),
            GDT_Language::make('site_language')->notNull()->initial('en'),
            GDT_Tags::make('site_tags'),
            
            GDT_Date::make('site_launchdate'),
            GDT_Date::make('site_joindate')->editable(false),
            
            GDT_Checkbox::make('site_autoupdate')->initial('0'),
            GDT_Secret::make('site_authkey')->max(32),
//             GDT_Secret::make('site_xauthkey')->max(32)->initialRandom(),
            
            GDT_UInt::make('site_maxscore')->editable(false),
            GDT_UInt::make('site_challcount')->editable(false),
            GDT_UInt::make('site_usercount')->editable(false),
            GDT_UInt::make('site_linkcount')->editable(false),
            
            GDT_UInt::make('site_score')->initial('0')->editable(false), # calced score
            GDT_UInt::make('site_basescore')->initial('10000'),
            GDT_Decimal::make('site_avg')->digits(1, 4)->editable(false),
            
            GDT_Url::make('site_url')->reachable(),
            GDT_String::make('site_irc'),
            GDT_String::make('site_url_mail'),
            GDT_String::make('site_url_score'),
            GDT_String::make('site_url_profile'),
            
            GDT_EditedAt::make('site_edited_at'),
            GDT_EditedBy::make('site_edited_by'),
            
            GDT_CreatedAt::make('site_created_at'),
            GDT_CreatedBy::make('site_created_by'),
            
            GDT_Join::make('site_diff')->join("wc_sitediff ON sitediff_site = site_id"),
        );
    }
    
    public function getName() { return $this->getVar('site_name'); }
    public function getURL() { return $this->getVar('site_url'); }
    public function displayName() { return html($this->getName()); }
    public function displayLogo() { return WC_SiteLogo::make()->gdo($this)->renderCell(); }
    public function getState() { return $this->getVar('site_status'); }
    public function hasState(string $state) { return $this->getState() === $state; }
    public function isUp() { return $this->hasState('up'); }
    public function isSiteLinked(GDO_User $user) { return WC_RegAt::getFor($user, $this); }
        

    public function href_edit_site() { return href('WeChall', 'CRUDSite', '&id='.$this->getID()); }
    public function href_site_details() { return href('WeChall', 'Site', '&id='.$this->getID()); }
    public function href_site_admins() { return href('WeChall', 'SiteAdmins', '&id='.$this->getID()); }
    public function href_site_descriptions() { return href('WeChall', 'SiteDescriptions', '&id='.$this->getID()); }
    public function renderList() { return GDT_Template::php('WeChall', 'list/site.php', ['field' => $this]); }
    public function renderChoice() { return GDT_Template::php('WeChall', 'cell/site_choice.php', ['site' => $this]); }
    
    public function canUpdate(GDO_User $user) { return $user->isStaff() || $this->isSiteAdmin($user); }

    public function isSiteAdmin(GDO_User $user)
    {
        
    }
    
    #############
    ### Cache ###
    #############
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