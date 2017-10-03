<?php
use GDO\WeChall\Module_WeChall;
use GDO\WeChall\WC_Site;
use GDO\OnlineUsers\GDT_NewestUsers;
use GDO\OnlineUsers\GDT_OnlineUsers;
$module = Module_WeChall::instance();
$sitesT = WC_Site::table();
$sites = $sitesT->all();
$sitesT->sort($sites, 'site_created_at', false);
$sitesT->sort($sites, 'site_joindate', false);
$users = GDT_NewestUsers::getNewestUsers();
$online = GDT_OnlineUsers::getOnlineUsers();
?>
<header>
  <span class="wc-logo"></span>
  <span class="wc-new-sites">
<?php foreach ($sites as $site) : ?>
<?php endforeach; ?>
  </span>
  <span class="wc-new-users">
<?php foreach ($users as $user) : ?>
<?php endforeach; ?>
  </span>
  <span class="wc-online-users">
<?php foreach ($users as $user) : ?>
<?php endforeach; ?>
  </span>
</header>

