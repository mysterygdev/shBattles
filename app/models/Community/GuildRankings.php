<?php

namespace Models\Community;

use Illuminate\Database\Capsule\Manager as DB;
Use DB\Queries\Shaiya\Guilds;

class GuildRankings
{
    public function getGuildRankings()
    {
        return Guilds\GuildRankings::getGuilds();
    }
}
