<?php
/**
 * The productplans entry point of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2021 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     entries
 * @version     1
 * @link        https://www.zentao.pm
 */
class productplansEntry extends entry
{
    /**
     * GET method.
     *
     * @param  int    $productID
     * @access public
     * @return void
     */
    public function get($productID = 0)
    {
        if(!$productID) $productID = $this->param('product', 0);
        if(!$productID) return $this->sendError(400, 'No product id.');

        $control = $this->loadController('productplan', 'browse');
        $control->browse($productID, $this->param('branch', 0), $this->param('status', 'all'), $this->param('order', 'begin_desc'), 0, $this->param('limit', 20), $this->param('page', 1));

        /* Response */
        $data = $this->getData();
        if(isset($data->status) and $data->status == 'success')
        {
            $result = array();
            $plans  = $data->data->plans;
            $pager  = $data->data->pager;

            foreach($plans as $plan)
            {
                if($plan->parent > 0 and isset($result[$plan->parent]))
                {
                    $parentPlan = $result[$plan->parent];

                    if(!isset($parentPlan->children) or !is_array($parentPlan->children)) $parentPlan->children = array();
                    $parentPlan->children[] = $plan;
                    $result[$plan->parent]  = $parentPlan;
                }
                else
                {
                    $result[$plan->id] = $this->format($plan, 'begin:date,end:date,deleted:bool,project:int');
                }
            }

            return $this->send(200, array('page' => $pager->pageID, 'total' => $pager->recTotal, 'limit' => $pager->recPerPage, 'plans' => array_values($result)));
        }

        if(isset($data->status) and $data->status == 'fail') return $this->sendError(zget($data, 'code', 400), $data->message);

        return $this->sendError(400, 'error');
    }

    /**
     * POST method.
     *
     * @param  int    $productID
     * @access public
     * @return void
     */
    public function post($productID = 0)
    {
        if(!$productID) $productID = $this->param('product', 0);
        if(!$productID) return $this->sendError(400, 'No product id.');

        $fields = 'branch,begin,end,title,desc';
        $this->batchSetPost($fields);
        $this->setPost('product', $productID);
        $this->setPost('parent', $this->request('parent', 0));
        $this->setPost('branch', $this->request('branch', 0));

        $control = $this->loadController('productplan', 'create');
        $control->create($productID, $this->param('branch', 0), $this->param('parent', 0));

        $data = $this->getData();
        if(isset($data->result) and $data->result == 'success')
        {
            $plan = $this->loadModel('productplan')->getByID($data->id);
            $plan->stories = array();
            $plan->bugs    = array();
            return $this->send(200, $this->format($plan, 'begin:date,end:date,deleted:bool,project:int'));
        }

        $this->sendError(400, array('message' => isset($data->message) ? $data->message : 'error'));
    }
}
