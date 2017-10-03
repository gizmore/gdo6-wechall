<?php
namespace GDO\WeChall;
use GDO\Vote\GDO_VoteTable;
final class WC_SiteDiffVote extends GDO_VoteTable
{
    public function gdoVoteObjectTable() { return WC_SiteDiff::table(); }
}
