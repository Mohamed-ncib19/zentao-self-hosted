<?php
/**
 * The fixFirst view file of execution module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     execution
 * @version     $Id$
 * @link        https://www.zentao.pm
 */
?>
<?php include '../../common/view/header.lite.html.php';?>
<div id='mainContent' class='main-content'>
<div class='main-header'>
  <h2><?php echo $lang->execution->fixFirst;?></h2>
</div>
  <form target='hiddenwin' method='post'>
    <table class='table table-form'>
      <tr>
        <td>
          <div class='input-group'>
            <span class='input-group-addon'><?php echo $execution->begin?></span>
            <?php echo html::input('estimate', !empty($firstBurn->estimate) ? $firstBurn->estimate : (!empty($firstBurn->left) ? $firstBurn->left : ''), "class='form-control' placeholder='{$lang->execution->placeholder->totalLeft}'")?>
            <span class='input-group-addon fix-border'>
              <div class='checkbox-primary'>
                <input id='withLeft' type='checkbox' checked name='withLeft' value='1' />
                <label for='withLeft'><?php echo $lang->execution->fixFirstWithLeft?></label>
              </div>
            </span>
            <span class='input-group-btn'><?php echo html::submitButton($lang->save, '', "btn btn-primary");?></span>
          </div>
        </td>
      </tr>
      <tr>
        <td>
          <div class='alert alert-primary no-margin'><?php echo $lang->execution->totalEstimate;?> : <code class='strong text-primary'><?php echo $execution->totalEstimate;?></code> <?php echo $lang->execution->workHour;?></div>
        </td>
      </tr>
    </table>
  </form>
</div>
<?php include '../../common/view/footer.lite.html.php';?>
