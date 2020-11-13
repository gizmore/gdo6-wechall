<?php
namespace GDO\WeChall;

use GDO\Core\GDO_Module;
use GDO\User\GDT_Level;
use GDO\UI\GDT_Link;
use GDO\UI\GDT_Page;

/**
 * GDO6 port of the wechall.net website
 * @author gizmore
 * @version 6.01
 * @since 6.00
 */
final class Module_WeChall extends GDO_Module
{
	public $module_license = 'WPL';
    public $module_priority = 96;
    public function isSiteModule() { return true; }
    public function getTheme() { return 'wechall'; }
    public function onLoadLanguage() { $this->loadLanguage('lang/wechall'); }
    
    public function getConfig()
    {
        return [
            GDT_Level::make('site_vote_min_score')->initial('700'), # thx awe
        ];
    }
    
    public function getDependencies()
    {
    	return ['News', 'Forum', 'Download', 'Links', 'Shoutbox', 'Usergroup', 'Tag', 'Vote', 'PM', 'Mibbit'];
    }
    
    public function getClasses()
    {
        return [
            WC_Challenge::class,
            WC_ChallDiff::class,
            WC_ChallDiffVote::class,
            WC_Site::class,
            WC_SiteTag::class,
            WC_SiteDiff::class,
            WC_SiteDiffVote::class,
            WC_SiteAdmin::class,
            WC_RegAt::class,
        ];
    }
    
    #############
    ### Hooks ###
    #############
    public function onInitSidebar()
    {
        $bar = GDT_Page::$INSTANCE->leftNav;
        $bar->addField(GDT_Link::make('menu_sites')->href(href('WeChall', 'Sites')));
        $bar = GDT_Page::$INSTANCE->rightNav;
        $bar->addField(GDT_Link::make('menu_linked_sites')->href(href('WeChall', 'LinkedSites')));
    }

}
