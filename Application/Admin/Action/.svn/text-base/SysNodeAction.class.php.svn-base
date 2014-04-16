<?php

namespace Admin\Action;

/**
 * =================================================
 * 系统节点管理控制器
 * ================================================
 * @category happy
 * @package Admin/
 * @subpackage Action
 * @author Happy <yangbai6644@163.com>
 * @dateTime 2014-1-4 11:48:35
 * ================================================
 */
class SysNodeAction extends \Common\Action\CommonAction {

    /**
     * 首页显示前置方法
     */
    public function _before_index() {
        $this->assign('nodeList', json_encode(D('SysNode')->getTreeData()));
    }
    
    /**
     * 显示添加页面
     */
    public function add() {
        $vo = array(
            'pid' => $_GET['pid'],
            'level' =>  $_GET['level'],
            'pname' =>  M('SysNode')->where(array('id'=>$_GET['pid']))->getField('name'),
        );
        $this->action = 'insert';
        $this->vo = $vo;
        $this->display('node');
    }
    
    /**
     * 显示编辑页面
     */
    public function edit() {
        $this->action = 'update';
        parent::edit(NULL, 'node');
    }

}
