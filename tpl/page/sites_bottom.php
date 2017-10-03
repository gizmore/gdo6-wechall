<?php
use GDO\Template\GDT_Panel;
use GDO\UI\GDT_IconButton;

echo GDT_IconButton::make()->href(href('WeChall', 'CRUDSite'))->icon('create');

echo GDT_Panel::make()->html(t('wc_sites_about'));
