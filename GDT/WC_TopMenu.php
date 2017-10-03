<?php
namespace GDO\WeChall\GDT;
use GDO\Template\GDT_Bar;
use GDO\UI\GDT_Link;
use GDO\User\GDO_User;
/**
 * WeChall6 Topmenu.
 * Inherit from bar and add links according to permissions.
 * @author gizmore
 */
final class WC_TopMenu extends GDT_Bar
{
    public function __construct()
    {
        $this->user(GDO_User::current());
    }
    
    public function user(GDO_User $user)
    {
        $this->removeFields();
        $this->addField(GDT_Link::make('menu_news')->href(href('News', 'NewsList')));
        $this->addField(GDT_Link::make('menu_links')->href(href('Links', 'Overview')));
        $this->addField(GDT_Link::make('menu_sites')->href(href('WeChall', 'Sites')));
        $this->addField(GDT_Link::make('menu_forum')->href(href('Forum', 'Boards')));
        $this->addField(GDT_Link::make('menu_ranking')->href(href('WeChall', 'Ranking')));
        $this->addField(GDT_Link::make('menu_challenges')->href(href('WeChall', 'Challenges')));
        if ($user->isAuthenticated())
        {
            $this->addField(GDT_Link::make('menu_profile')->href(href('WeChall', 'Profile')));
            $this->addField(GDT_Link::make('menu_pm')->href(href('PM', 'Overview')));
        }
        $this->addField(GDT_Link::make('menu_downloads')->href(href('Download', 'FileList')));
        if ($user->isAuthenticated())
        {
            $this->addField(GDT_Link::make('menu_usergroups')->href(href('Usergroups', 'Overview')));
        }
        if ($user->isGhost())
        {
            $this->addField(GDT_Link::make('menu_register')->href(href('Register', 'Form')));
        }
        if ($user->isAdmin())
        {
            $this->addField(GDT_Link::make('menu_admin')->href(href('Admin', 'Modules')));
        }
        if ($user->isAuthenticated())
        {
            $this->addField(GDT_Link::make('menu_logout')->href(href('Login', 'Logout')));
            $this->addField(GDT_Link::make()->href(href('Profile', 'Show', '&user='.$user->getID()))->rawLabel("[{$user->displayNameLabel()}]"));
            
            
            
        }
    }
}