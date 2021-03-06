<?php
/**
 * Yasmin
 * Copyright 2017 Charlotte Dunois, All Rights Reserved
 *
 * Website: https://charuru.moe
 * License: https://github.com/CharlotteDunois/Yasmin/blob/master/LICENSE
*/

namespace CharlotteDunois\Yasmin\WebSocket\Events;

/**
 * WS Event
 * @see https://discordapp.com/developers/docs/topics/gateway#guild-ban-add
 * @internal
 */
class GuildBanAdd {
    protected $client;
    
    function __construct(\CharlotteDunois\Yasmin\Client $client) {
        $this->client = $client;
    }
    
    function handle(array $data) {
        $guild = $this->client->guilds->get($data['guild_id']);
        if($guild) {
            $user = $this->client->users->patch($data);
            if($user) {
                $user = new \React\Promise\resolve($user);
            } else {
                $user = $this->client->fetchUser($data['id']);
            }
        
            $user->then(function ($user) use ($guild) {
                $this->client->emit('guildBanAdd', $guild, $user);
            });
        }
    }
}
