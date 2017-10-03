<?php
namespace GDO\WeChall;
use GDO\Vote\GDO_VoteTable;
final class WC_ChallDiffVote extends GDO_VoteTable
{
    public function gdoVoteObjectTable() { return WC_ChallDiff::table(); }
}
