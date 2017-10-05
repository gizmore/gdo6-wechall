<?php
namespace GDO\WeChall;
use GDO\Net\HTTP;
use GDO\Net\GDT_IP;
use GDO\Type\GDT_Token;

$debug = GWF_DEBUG_EMAIL && GDT_IP::isLocal();
define('WECHALL_DEBUG_SCORING', $debug); # set true to debug scoring events.

/**
 * Utility for scoring update tasks.
 * @author gizmore
 */
final class WC_Update
{
    public static function getSiteBaseURL(WC_Site $site, string $field)
    {
        if ($url = $site->getVar($field))
        {
            if (!strpos($url, '://'))
            {
                $url = rtrim($site->getURL(), '/') . '/' . ltrim($url, '/');
            }
            return $url;
        }
    }
    
    public static function getSiteURL(WC_Site $site, string $field, string $onsitename, string $onsitemail='')
    {
        if ($url = self::getSiteBaseURL($site, $field))
        {
            $replace = array(
                '%USERNAME%' => $onsitename,
                '%EMAIL%' => $onsitemail,
                '%AUTHKEY%' => $site->getVar('site_authkey'),
            );
            return str_replace(array_keys($replace), array_values($replace), $url);
        }
    }
    
    public static function getLinkToken(WC_Site $site, string $onsitename, int $hidden)
    {
        return GDT_Token::generate($site->getID().$onsitename.$hidden);
    }
    
    public static function combinationExists(WC_Site $site, string $onsitename, $onsitemail)
    {
        $url = self::getSiteURL($site, 'site_url_mail', $onsitename, $onsitemail);

        if (WECHALL_DEBUG_SCORING)
        {
            echo "<div>SECRET_URL: $url</div>";
        }
        
        $result = HTTP::getFromURL($url);
        
        if (WECHALL_DEBUG_SCORING)
        {
            var_dump(html($result));
        }
        
        $result = trim(str_replace("\xEF\xBB\xBF", '', $result));
        return $result === '1';
    }
}
