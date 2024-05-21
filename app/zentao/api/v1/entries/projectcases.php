<?php
/**
 * The project cases entry point of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2021 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     entries
 * @version     1
 * @link        https://www.zentao.pm
 */
class projectCasesEntry extends entry
{
    /**
     * GET method.
     *
     * @param  int    $projectID
     * @access public
     * @return void
     */
    public function get($projectID = 0)
    {
        if(!$projectID) $projectID   = $this->param('project', 0);
        if(empty($projectID)) return $this->sendError(400, 'Need project id.');

        $this->resetOpenApp('project');
        $this->app->session->set('project', $projectID, $this->app->tab);

        $control = $this->loadController('project', 'testcase');
        $control->testcase($projectID, $this->param('product', 0), $this->param('branch', 0), $this->param('status', 'all'), 0, $this->param('order', 'id_desc'), 0, $this->param('limit', 20), $this->param('page', 1));

        $data = $this->getData();

        if(isset($data->status) and $data->status == 'success')
        {
            $cases  = $data->data->cases;
            $pager  = $data->data->pager;
            $result = array();
            foreach($cases as $case)
            {
                $case->statusName = $this->lang->testcase->statusList[$case->status];
                $result[] = $this->format($case, 'openedDate:time,reviewedDate:date,lastEditedDate:time,lastRunDate:time');
            }

            return $this->send(200, array('page' => $pager->pageID, 'total' => $pager->recTotal, 'limit' => $pager->recPerPage, 'cases' => $result));
        }

        if(isset($data->status) and $data->status == 'fail') return $this->sendError(zget($data, 'code', 400), $data->message);
        return $this->sendError(400, 'error');
    }
}
