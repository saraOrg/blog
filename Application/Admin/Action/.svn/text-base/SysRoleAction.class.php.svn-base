<?php

namespace Admin\Action;

/**
 * =================================================
 * 系统角色管理控制器
 * ================================================
 * @category happy
 * @package Admin/
 * @subpackage Action
 * @author Happy <yangbai6644@163.com>
 * @dateTime 2014-1-4 16:29:16
 * ================================================
 */
class SysRoleAction extends \Common\Action\CommonAction {

    public function add() {
        $this->action = 'insert';
        $this->display('role');
    }

    public function edit() {
        $this->action = 'update';
        parent::edit(NULL, 'role');
    }

    public function access() {
        $this->nodeList = recursionNode(M('SysNode')->where(array('status'=>1))->select());
        $this->accessList = M('SysAccess')->where(array('role_id'=>$_GET['id']))->getField('node_id', true);
        $this->display('access');
    }

    public function setAccess() {
        $data  = array();
        foreach ($_POST['node'] as $key => $node) {
            $data[] = array(
                'role_id' => $_POST['role_id'],
                'node_id' => $node,
                'level'   => $_POST['level'][$key],
            );
        }
        M('SysAccess')->where(array('role_id'=>$_POST['role_id']))->delete();
        if (false !== M('SysAccess')->addAll($data)) {
            $this->success('角色权限配置成功！');
        } else {
            $this->error('角色权限配置失败！');
        }
    }

}
