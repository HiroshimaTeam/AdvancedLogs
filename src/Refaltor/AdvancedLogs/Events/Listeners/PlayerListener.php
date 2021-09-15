<?php

/*
 *    .--.  .----. .-. .-.  .--.  .-. .-. .---. .----..----.    .-.    .----.  .---.  .----.
 *   / {} \ | {}  \| | | | / {} \ |  `| |/  ___}| {_  | {}  \   | |   /  {}  \/   __}{ {__
 *  /  /\  \|     /\ \_/ //  /\  \| |\  |\     }| {__ |     /   | `--.\      /\  {_ }.-._} }
 *  `-'  `-'`----'  `---' `-'  `-'`-' `-' `---' `----'`----'    `----' `----'  `---' `----'
 *
 * Copyright (C) 2021  ! Refaltor#7393
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 *
 * github: https://github.com/Refaltor77
 */

namespace Refaltor\AdvancedLogs\Events\Listeners;

use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\Player;
use Refaltor\AdvancedLogs\Libs\Discord\Message;
use Refaltor\AdvancedLogs\Libs\Discord\Webhook;
use Refaltor\AdvancedLogs\Loader;

class PlayerListener implements Listener
{
    /** @var Loader */
    public $loader;

    public function __construct(Loader $loader)
    {
        $this->loader = $loader;
    }

    public function onJoin(PlayerJoinEvent $event): void
    {
        $player = $event->getPlayer();
        $array = $this->loader->getConfig()->getAll();
        if ($array['logs']['player_join']['active']) {
            $message = new Message();
            $msg = str_replace(['{time}', '{player}'], [date("H:i:s"), $player->getName()], $array['logs']['player_join']['log']);
            $message->setContent($msg);
            $webhook = new Webhook($array['logs']['player_join']['url']);
            $webhook->send($message);
        }
    }

    public function onQuit(PlayerQuitEvent $event): void
    {
        $player = $event->getPlayer();
        $array = $this->loader->getConfig()->getAll();
        if ($array['logs']['player_quit']['active']) {
            $message = new Message();
            $msg = str_replace(['{time}', '{player}'], [date("H:i:s"), $player->getName()], $array['logs']['player_quit']['log']);
            $message->setContent($msg);
            $webhook = new Webhook($array['logs']['player_quit']['url']);
            $webhook->send($message);
        }
    }

    public function onSendMessageInChat(PlayerChatEvent $event): void
    {
        $player = $event->getPlayer();
        $array = $this->loader->getConfig()->getAll();
        if ($array['logs']['messages']['active']) {
            $message = new Message();
            $msg = str_replace(['{time}', '{player}', '{msg}'], [date("H:i:s"), $player->getName(), $event->getMessage()], $array['logs']['messages']['log']);
            $message->setContent($msg);
            $webhook = new Webhook($array['logs']['messages']['url']);
            $webhook->send($message);
        }
    }

    public function onDeath(PlayerDeathEvent $event): void
    {
        $victim = $event->getPlayer();
        $cause = $victim->getLastDamageCause()->getCause();
        if ($cause === EntityDamageByEntityEvent::CAUSE_ENTITY_ATTACK) {
            $damager = $victim->getLastDamageCause()->getDamager();
            if ($damager instanceof Player) {
                $array = $this->loader->getConfig()->getAll();
                if ($array['logs']['player_death']['active']) {
                    $message = new Message();
                    $msg = str_replace(['{time}', '{victim}', '{killer}'], [date("H:i:s"), $victim->getName(), $damager->getName()], $array['logs']['player_death']['log']);
                    $message->setContent($msg);
                    $webhook = new Webhook($array['logs']['player_death']['url']);
                    $webhook->send($message);
                }
            }
        }
    }
}