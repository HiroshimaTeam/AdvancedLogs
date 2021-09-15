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

namespace Refaltor\AdvancedLogs\Libs\Discord;

use pocketmine\Server;
use Refaltor\AdvancedLogs\AsyncTasks\SendLogsAsync;

class Webhook
{
    /** @var string */
    protected $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function getURL(): string
    {
        return $this->url;
    }

    public function isValid(): bool
    {
        return filter_var($this->url, FILTER_VALIDATE_URL) !== false;
    }

    public function send(Message $message): void
    {
        Server::getInstance()->getAsyncPool()->submitTask(new SendLogsAsync($this, $message));
    }
}