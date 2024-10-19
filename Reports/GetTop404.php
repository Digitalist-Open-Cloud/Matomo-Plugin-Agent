<?php

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
