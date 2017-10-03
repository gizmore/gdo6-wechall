<?php
namespace GDO\WeChall;
use GDO\DB\GDO;
use GDO\DB\GDT_Object;
use GDO\Vote\WithVotes;
use GDO\Vote\GDT_VoteCount;
use GDO\Vote\GDT_VoteRating;
/**
 * Extra table for challenge difficulty outcome.
 * That's the way module votes works, so we can have multiple vote types per challenge; diff, edu, fun.
 * @author gizmore
 */
final class WC_SiteDiff extends GDO
{
    use WithVotes;
    public function gdoVoteTable() { return WC_SiteDiffVote::table(); }
    
    public function gdoColumns()
    {
        return array(
            GDT_Object::make('sitediff_site')->primary()->table(WC_Challenge::table()),
            GDT_VoteCount::make('sitediff_votes'),
            GDT_VoteRating::make('sitediff_rating'),
        );
    }
}
