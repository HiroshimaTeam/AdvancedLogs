<?php

namespace Refaltor\AdvancedLogs\Libs\Discord;

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

use JsonSerializable;

class Message implements JsonSerializable
{

    /** @var array */
    protected $data = [];

    public function setContent(string $content): void
    {
        $this->data["content"] = $content;
    }

    public function getContent(): ?string
    {
        return $this->data["content"];
    }

    public function getUsername(): ?string
    {
        return $this->data["username"];
    }

    public function setUsername(string $username): void
    {
        $this->data["username"] = $username;
    }

    public function getAvatarURL(): ?string
    {
        return $this->data["avatar_url"];
    }

    public function setAvatarURL(string $avatarURL): void
    {
        $this->data["avatar_url"] = $avatarURL;
    }

    public function addEmbed(Embed $embed): void
    {
        if (!empty(($arr = $embed->asArray()))) {
            $this->data["embeds"][] = $arr;
        }
    }

    public function setTextToSpeech(bool $ttsEnabled): void
    {
        $this->data["tts"] = $ttsEnabled;
    }

    public function jsonSerialize(): array
    {
        return $this->data;
    }
}