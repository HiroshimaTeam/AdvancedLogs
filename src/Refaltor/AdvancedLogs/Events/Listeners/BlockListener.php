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

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\Listener;
use Refaltor\AdvancedLogs\Libs\Discord\Message;
use Refaltor\AdvancedLogs\Libs\Discord\Webhook;
use Refaltor\AdvancedLogs\Loader;

class BlockListener implements Listener
{

    /** @var Loader */
    public $loader;

    public function __construct(Loader $loader)
    {
        $this->loader = $loader;
    }


    public function onBlockPlace(BlockPlaceEvent $event): void
    {
        $player = $event->getPlayer();
        $block = $event->getBlock();
        $array = $this->loader->getConfig()->getAll();
        if ($array['logs']['block_place']['active']) {
            $message = new Message();
            $msg = str_replace(['{time}', '{player}', '{block_name}', '{id}'], [date("H:i:s"), $player->getName(), $block->getName(), $block->getId() . ':' . $block->getDamage()], $array['logs']['block_place']['log']);
            $message->setContent($msg);
            $webhook = new Webhook($array['logs']['block_place']['url']);
            $webhook->send($message);
        }
    }

    public function onBlockBreak(BlockBreakEvent $event): void
    {
        $player = $event->getPlayer();
        $block = $event->getBlock();
        $array = $this->loader->getConfig()->getAll();
        if ($array['logs']['block_break']['active']) {
            $message = new Message();
            $msg = str_replace(['{time}', '{player}', '{block_name}', '{id}'], [date("H:i:s"), $player->getName(), $block->getName(), $block->getId() . ':' . $block->getDamage()], $array['logs']['block_break']['log']);
            $message->setContent($msg);
            $webhook = new Webhook($array['logs']['block_break']['url']);
            $webhook->send($message);
        }
    }
}