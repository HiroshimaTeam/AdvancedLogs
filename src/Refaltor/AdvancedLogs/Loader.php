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


namespace Refaltor\AdvancedLogs;

use pocketmine\plugin\PluginBase;
use Refaltor\AdvancedLogs\Events\Listeners\BlockListener;
use Refaltor\AdvancedLogs\Events\Listeners\PlayerListener;
use Refaltor\AdvancedLogs\Traits\UtilsTrait;

class Loader extends PluginBase
{
    use UtilsTrait;

    public function onEnable()
    {
        $events = [new BlockListener($this), new PlayerListener($this)];
        foreach ($events as $event) $this->registerEvent($event, $this);
    }
}