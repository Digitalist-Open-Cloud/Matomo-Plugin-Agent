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

use Piwik\Plugin\ViewDataTable;
use Piwik\Piwik;

class GetErrorTypes extends Base
{
    protected function init()
    {

        parent::init();
        $this->name = Piwik::translate('Agent_ErrorTypes');
        $this->dimension     = null;
        $this->subcategoryId = 'Agent_ErrorTypes';
        $this->documentation = 'This pie chart shows the distribution of different error codes (404, 403, 500, etc.).';
        $this->order = 2;
    }

    /**
     * @param ViewDataTable $view
     */
    public function configureView(ViewDataTable $view)
    {
        $view->config->addTranslation('status_code', 'Code');
        $view->config->addTranslation('status_count', 'Count');

        $view->config->columns_to_display = ['status_code', 'status_count'];
    }

    /**
     * @return \Piwik\Plugin\Report[]
     */
    public function getRelatedReports()
    {
        return [];
    }
    public function getDefaultTypeViewDataTable()
    {
        return 'graphPie';
    }
    public function alwaysUseDefaultViewDataTable()
    {
        return true;
    }
}
