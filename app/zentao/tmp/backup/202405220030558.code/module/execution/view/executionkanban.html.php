<?php
/**
 * The execution kanban view file of execution module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2021 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @author      Qiyu Xie
 * @package     execution
 * @version     $Id: executionkanban.html.php $
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/kanban.html.php';?>
<?php if(empty($kanbanGroup)):?>
<div class="table-empty-tip cell">
  <p class="text-muted"><?php echo $lang->execution->noExecutions;?></p>
</div>
<?php else:?>
<div class='panel kanban-panel' id='kanbanList'>
    <div class='panel-body'>
      <div id='kanban' class='kanban'></div>
    </div>
  </div>
</div>
<?php
$userPrivs = array();
$userPrivs['project']   = common::hasPriv('project', 'index');
$userPrivs['execution'] = common::hasPriv('execution', 'task');
js::set('userPrivs',        $userPrivs);
js::set('kanbanGroup', $kanbanGroup);
js::set('kanbanColumns', $lang->execution->kanbanColType);
js::set('statusColorList', $lang->execution->statusColorList);
js::set('langMyExecutions', $lang->execution->myExecutions);
js::set('langDoingProject', $lang->execution->doingProject);
js::set('projectNames', $projects);
js::set('priv',
    array(
        'canStart'    => common::hasPriv('execution', 'start'),
        'canSuspend'  => common::hasPriv('execution', 'suspend'),
        'canClose'    => common::hasPriv('execution', 'close'),
        'canActivate' => common::hasPriv('execution', 'activate'),
    )
);
?>
<?php endif;?>
<?php include '../../common/view/footer.html.php';?>
