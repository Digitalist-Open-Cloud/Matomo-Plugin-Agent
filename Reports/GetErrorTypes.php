<?php

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
