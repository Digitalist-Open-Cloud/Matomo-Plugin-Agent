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

namespace Piwik\Plugins\Agent\Reports;

use Piwik\Piwik;
use Piwik\Plugin\ViewDataTable;

class GetTop404 extends Base
{
    protected function init()
    {
        parent::init();

        $this->name          = Piwik::translate('Agent_Top404Urls');
        $this->dimension     = null;
        $this->documentation = Piwik::translate('Agent reports');
        $this->subcategoryId = 'Agent_Top404';
        $this->order = 1;
    }

    /**
     * @param ViewDataTable $view
     */
    public function configureView(ViewDataTable $view)
    {
        $view->config->columns_to_display = ['url', 'error_count'];
        $view->config->translations['url'] = Piwik::translate('Agent_URL');
        $view->config->translations['error_count'] = Piwik::translate('Agent_ErrorCount');
        $view->config->show_table_all_columns = false;  // Only show relevant columns
    }


    /**
     * @return \Piwik\Plugin\Report[]
     */
    public function getRelatedReports()
    {
        return [];
    }
}
