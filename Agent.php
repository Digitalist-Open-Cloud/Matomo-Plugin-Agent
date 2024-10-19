<?php

/**
 * The Matomo Agent plugin for Matomo.
 *
 * Copyright (C) 2024 Digitalist Open Cloud <cloud@digitalist.com>
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
 */

namespace Piwik\Plugins\Agent;

use Piwik\Db;
use Piwik\Common;

class Agent extends \Piwik\Plugin
{

    public function install()
    {
        $query = "CREATE TABLE IF NOT EXISTS " . Common::prefixTable('agent_log') . " (
            id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
            idsite INT(4) UNSIGNED NOT NULL,
            url VARCHAR(255) NOT NULL,
            status_code INT(3) NOT NULL,
            time DATETIME NOT NULL,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        Db::query($query);
    }

    public function uninstall()
    {
        Db::query("DROP TABLE IF EXISTS " . Common::prefixTable('agent_log'));
    }
}
