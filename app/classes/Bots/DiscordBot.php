<?php

namespace Classes\Bots;

use Discord\Discord;
use Discord\WebSockets\Event;
use Discord\WebSockets\Intents;
use Discord\Parts\Channel\Channel;

class DiscordBot
{
    public function __construct()
    {
        //
        $discord = new Discord(['token' => $this->getToken()]);
        $this->discord = $discord;
        $discord->on('ready', function (Discord $discord) {
            echo 'bot is ready';
            $this->guild = $discord->guilds->get('id', '951311722185113651');

            /* $newchannel = $guild->channels->create([
                'name' => 'mychannel',
                'type' => Channel::TYPE_TEXT,
                'topic' => 'Welcome to my channel!',
                'nsfw' => false
            ]);

            $channel = $discord->getChannel('951311722642288691');
            $channel->sendMessage('Hello');

            $guild->channels->save($newchannel)->done(function (Channel $channel) {
                echo 'Created a new text channel - ID: ', $channel->id;
            }); */

            //echo $this->getChannelByName('general');

            $discord->on('message', function ($message, $discord) {
                echo 'message..';
                $content = $message->content;

                if (strpos($content, '!') === false) {
                    return;
                }

                if ($content === '!help') {
                    echo 'help lol';
                }
            });
            $general = $this->getChannelByName('general');
            echo $general;
            $this->sendMessage($general, 'helloooi');
        });
        $discord->run();
    }

    public function getToken(): string
    {
        $string = 'OTUxNjU2MjUzNzk5Njc3OTgy.Yiqo8w.Ad-y99WX4zx2I3onsrf27812YAM';
        return $string;
    }

    public function getChannelByName($name)
    {
        $channel = $this->guild->channels->get('name', $name);
        return $channel;
    }

    public function createChannel()
    {
        //
    }

    public function deleteChannel()
    {
        //
    }

    public function sendMessage($channel, $message)
    {
        $channel->sendMessage($message);
    }
}
