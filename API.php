<?php

/**
 * The Agent plugin for Matomo.
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

use Piwik\DataTable;
use Piwik\Period;
use Piwik\Plugins\CoreVisualizations\Visualizations\JqplotGraph\Evolution;
use Piwik\Common;
use Piwik\Date;
use Piwik\Db;
use Piwik\Plugin\API as MatomoAPI;

class API extends MatomoAPI
{
    public function postLogData()
    {
        $request = \Piwik\Request::fromPost();
        $idSite = $request->getBoolParameter('idsite', 1);
        $url = $request->getStringParameter('url');
        $statusCode = $request->getStringParameter('status_code', 200);

        $url = Common::sanitizeInputValues($url);
        $statusCode = intval($statusCode);
        $time = Date::factory('now')->getDatetime();

        Db::query(
            "INSERT INTO " . Common::prefixTable('agent_log') . "
                    (idsite, url, status_code, time)
                    VALUES (?, ?, ?, ?)",
            array($idSite, $url, $statusCode, $time)
        );

        return ['status' => 'success', 'message' => 'Data inserted successfully'];
    }

    /**
     * @return DataTable
     */
    private static function getDataTable($rows)
    {
        return DataTable::makeFromIndexedArray($rows);
    }

    private static function getDb()
    {
        return Db::get();
    }
    /**
     * @param int    $idSite
     * @param string $period
     * @param string $date
     * @param bool|string $segment
     * @return DataTable
     */
    public function getTop404($idSite, $period, $date, $segment = false)
    {

        list($startDate, $endDate) = self::getDateRangeForPeriod($date, $period, false);
        $startDate = $startDate->toString();
        $endDate = $endDate->toString();
        $rows = self::getDb()->fetchAll(
            "SELECT url, COUNT(*) as error_count
        FROM " . Common::prefixTable('agent_log') . "
        WHERE status_code = 404
        AND idsite = ?
        AND date(time) between ? AND ?
        GROUP BY url
        ORDER BY error_count DESC
        LIMIT 10",
            [$idSite, $startDate, $endDate ]
        );

        return self::getDataTable($rows);
    }


    /**
     * @param int    $idSite
     * @param string $period
     * @param string $date
     * @param bool|string $segment
     * @return DataTable
     */
    public function getErrorTypes($idSite, $period, $date, $segment = false)
    {

        list($startDate, $endDate) = self::getDateRangeForPeriod($date, $period, false);
        $startDate = $startDate->toString();
        $endDate = $endDate->toString();

        $rows = self::getDb()->fetchAll(
            "SELECT status_code, COUNT(*) as status_count
                FROM " . Common::prefixTable('agent_log') . "
                WHERE idsite = ?
                AND date(time) between ? AND ?
                GROUP BY status_code
                ORDER BY status_count DESC",
            [$idSite, $startDate, $endDate ]
        );

        return self::getDataTable($rows);
    }

    public static function getDateRangeForPeriod($date, $period, $lastN = false)
    {
        $lastN = false;
        if ($date === false) {
            return [false, false];
        }

        $isMultiplePeriod = Period\Range::isMultiplePeriod($date, $period);

        // if the range is just a normal period (or the period is a range in which case lastN is ignored)
        if ($period == 'range') {
            $oPeriod = new Period\Range('day', $date);
            $startDate = $oPeriod->getDateStart();
            $endDate = $oPeriod->getDateEnd();
        } elseif ($lastN == false && !$isMultiplePeriod) {
            $oPeriod = Period\Factory::build($period, Date::factory($date));
            $startDate = $oPeriod->getDateStart();
            $endDate = $oPeriod->getDateEnd();
        } else { // if the range includes the last N periods or is a multiple period
            if (!$isMultiplePeriod) {
                list($date, $lastN) = Evolution::getDateRangeAndLastN($period, $date, $lastN);
            }
            list($startDate, $endDate) = explode(',', $date);

            $startDate = Date::factory($startDate);
            $endDate = Date::factory($endDate);
        }
        return [$startDate, $endDate];
    }
}
