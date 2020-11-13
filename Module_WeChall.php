<?php
namespace GDO\WeChall;
use GDO\Core\GDO_Module;
use GDO\User\GDT_Level;
use GDO\UI\GDT_Bar;
use GDO\UI\GDT_Link;
/**
 * GDO6 port of the wechall.net website
 * @author gizmore
 * @version 6.0.2
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
        return array(
            GDT_Level::make('site_vote_min_score')->initial('700'), # thx awe
        );
    }
    
    public function getDependencies()
    {
    	return ['News', 'Forum', 'Download', 'Links', 'Shoutbox', 'Usergroup', 'Tag', 'Vote', 'PM', 'Mibbit'];
    }
    
    public function getClasses()
    {
        return array(
            'GDO\\WeChall\\WC_Challenge',
            'GDO\\WeChall\\WC_ChallDiff',
            'GDO\\WeChall\\WC_ChallDiffVote',
            'GDO\\WeChall\\WC_Site',
            'GDO\\WeChall\\WC_SiteTag',
            'GDO\\WeChall\\WC_SiteDiff',
            'GDO\\WeChall\\WC_SiteDiffVote',
            'GDO\\WeChall\\WC_SiteAdmin',
            'GDO\\WeChall\\WC_RegAt',
        );
    }
    
    #############
    ### Hooks ###
    #############
    public function hookLeftBar(GDT_Bar $bar)
    {
        $bar->addField(GDT_Link::make('menu_sites')->href(href('WeChall', 'Sites')));
    }
    public function hookRightBar(GDT_Bar $bar)
    {
        $bar->addField(GDT_Link::make('menu_linked_sites')->href(href('WeChall', 'LinkedSites')));
    }
}
