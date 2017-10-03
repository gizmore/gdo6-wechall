<?php
use GDO\WeChall\WC_Site;
$field instanceof WC_Site;
$site = $field;
?>
<li class="wc-site">
  <a href="<?= $site->href_site_details(); ?>"><?= $site->displayName(); ?></a>
</li>