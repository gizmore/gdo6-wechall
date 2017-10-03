<?php
use GDO\Template\GDT_Template;
use GDO\Vote\GDT_VoteSelection;
use GDO\WeChall\WC_Site;
use GDO\WeChall\WC_SiteDiff;
$field instanceof GDT_Template;
$site = $field->gdo;
$site instanceof WC_Site;
$diff = WC_SiteDiff::forSite($site);
echo GDT_VoteSelection::make()->gdo($diff)->renderCell();
