<?php
/**
 * The story entry point of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2021 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     entries
 * @version     1
 * @link        https://www.zentao.pm
 */
class storyEntry extends Entry
{
    /**
     * GET method.
     *
     * @param  int    $storyID
     * @access public
     * @return void
     */
    public function get($storyID)
    {
        $this->resetOpenApp($this->param('tab', 'product'));

        $control = $this->loadController('story', 'view');
        $control->view($storyID);

        $data = $this->getData();

        if(!$data or !isset($data->status)) return $this->send400('error');
        if(isset($data->status) and $data->status == 'fail') return $this->sendError(zget($data, 'code', 400), $data->message);

        $story = $data->data->story;

        if(!empty($story->children)) $story->children  = array_values((array)$story->children);
        if(isset($story->planTitle)) $story->planTitle = array_values((array)$story->planTitle);
        if($story->parent > 0) $story->parentPri = $this->dao->select('pri')->from(TABLE_STORY)->where('id')->eq($story->parent)->fetch('pri');

        /* Set product name */
        $story->productName = $data->data->product->name;

        /* Set module title */
        $moduleTitle = '';
        if(empty($story->module)) $moduleTitle = '/';
        if($story->module)
        {
            $modulePath = $data->data->modulePath;
            foreach($modulePath as $key => $module)
            {
                $moduleTitle .= $module->name;
                if(isset($modulePath[$key + 1])) $moduleTitle .= '/';
            }
        }
        $story->moduleTitle = $moduleTitle;

        $storyTasks = array();
        foreach($story->tasks as $executionTasks)
        {
            foreach($executionTasks as $task)
            {
                if(!isset($data->data->executions->{$task->execution})) continue;
                $storyTasks[] = $this->filterFields($task, 'id,name,type');
            }
        }
        $story->tasks = $storyTasks;

        $story->bugs = array();
        foreach($data->data->bugs as $bug) $story->bugs[] = $this->filterFields($bug, 'id,title');

        $story->cases = array();
        foreach($data->data->cases as $case) $story->cases[] = $this->filterFields($case, 'id,title');

        $story->requirements = array();
        foreach($data->data->relations as $relation) $story->requirements[] = $this->filterFields($relation, 'id,title');

        $story->actions = $this->loadModel('action')->processActionForAPI($data->data->actions, $data->data->users, $this->lang->story);

        $preAndNext = $data->data->preAndNext;
        $story->preAndNext = array();
        $story->preAndNext['pre']  = $preAndNext->pre  ? $preAndNext->pre->id : '';
        $story->preAndNext['next'] = $preAndNext->next ? $preAndNext->next->id : '';

        $this->send(200, $this->format($story, 'openedBy:user,openedDate:time,assignedTo:user,assignedDate:time,reviewedBy:user,reviewedDate:time,lastEditedBy:user,lastEditedDate:time,closedBy:user,closedDate:time,deleted:bool,mailto:userList'));
    }

    /**
     * PUT method.
     *
     * @param  int    $storyID
     * @access public
     * @return void
     */
    public function put($storyID)
    {
        $oldStory = $this->loadModel('story')->getByID($storyID);

        /* Set $_POST variables. */
        $fields = 'type';
        $this->batchSetPost($fields, $oldStory);
        $this->setPost('parent', 0);

        $control = $this->loadController('story', 'edit');
        $control->edit($storyID);

        $this->getData();
        $story = $this->story->getByID($storyID);
        $this->send(200, $this->format($story, 'openedBy:user,openedDate:time,assignedTo:user,assignedDate:time,reviewedBy:user,reviewedDate:time,lastEditedBy:user,lastEditedDate:time,closedBy:user,closedDate:time,deleted:bool,mailto:userList'));
    }

    /**
     * DELETE method.
     *
     * @param  int    $storyID
     * @access public
     * @return void
     */
    public function delete($storyID)
    {
        $control = $this->loadController('story', 'delete');
        $control->delete($storyID, 'yes');

        $this->getData();
        $this->sendSuccess(200, 'success');
    }
}