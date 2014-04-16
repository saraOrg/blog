<?php

namespace Admin\Action;

/**
 * =================================================
 * Description of SysMenuAction
 * ================================================
 * @category happy
 * @package Admin/
 * @subpackage Action
 * @author Happy <yangbai6644@163.com>
 * @dateTime 2014-1-3 22:02:36
 * ================================================
 */
class SysMenuAction extends \Common\Action\CommonAction {

    /**
     * 首页前置方法
     */
    public function _before_index() {
        $this->menuList = D('SysMenu')->getTreeData();
    }

}
