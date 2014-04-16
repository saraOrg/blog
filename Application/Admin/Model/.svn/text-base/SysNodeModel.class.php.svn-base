<?php

namespace Admin\Model;

/**
 * =================================================
 * 系统节点管理模型
 * ================================================
 * @category happy
 * @package Admin/
 * @subpackage Action
 * @author Happy <yangbai6644@163.com>
 * @dateTime 2014-1-4 11:49:35
 * ================================================
 */
class SysNodeModel extends \Common\Model\CommonModel {

    /**
     * 返回zTree格式化的节点数据列表
     * @return string
     */
    public function getTreeData() {
        $nodes     = array();
        $nodes[]   = array('id' => 0, 'name' => '系统节点', 'pid' => 0, 'open' => true, 'nocheck' => true);
        $node_list = $this->order('sort ASC')->select();
        foreach ($node_list as $node) {
            $node['open']  = true;
            $node['pId']   = $node['pid'];
            (intval($node['status']) === 0) && $node['font'] = array('color' => 'red');
            $nodes[]       = $node;
        }
        return $nodes;
    }

}
