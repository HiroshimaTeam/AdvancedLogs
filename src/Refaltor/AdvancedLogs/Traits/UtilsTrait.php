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

namespace Refaltor\AdvancedLogs\Traits;

use pocketmine\event\Listener;
use pocketmine\plugin\Plugin;
use pocketmine\Server;

trait UtilsTrait
{
    public function registerEvent(Listener $event, Plugin $plugin): void
    {
        Server::getInstance()->getPluginManager()->registerEvents($event, $plugin);
    }
}