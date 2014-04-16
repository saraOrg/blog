<?php

namespace Admin\Action;

/**
 * =================================================
 * 系统用户管理
 * ================================================
 * @category happy
 * @package Admin/
 * @subpackage Action
 * @author Happy <yangbai6644@163.com>
 * @dateTime 2013-12-29 17:20:56
 * ================================================
 */
class SysUserAction extends \Common\Action\CommonAction {

    /**
     * 显示添加页面
     */
    public function add() {
        //分配操作url
        $this->action   = 'insert';
        $this->roleList = M('SysRole')->select();
        $this->display('user');
    }

    /**
     * 数据过滤函数
     * @param array $map
     */
    public function filterData(&$map) {
        $map['login_name'] = array('neq', 'admin');
    }

    /**
     * 显示编辑页面
     */
    public function edit() {
        //分配操作url
        $this->action   = 'update';
        $this->roleList = M('SysRole')->select();
        $this->roleUser = M('SysRoleUser')->where(array('user_id' => $_POST['id']))->getField('role_id', true);
        parent::edit(NULL, 'user');
    }

    public function foreverdelete() {
        $model = D('SysUser');
        $data  = isset($_REQUEST[$model->getPk()]) ? $_REQUEST[$model->getPk()] : $_REQUEST['id'];
        if (isset($data)) {
            $ids = explode(',', $data);
            if (false !== $model->where(array($model->getPk() => array('in', $ids)))->delete()) {
                $model->foreverdelete($ids);
                $this->success('删除成功！');
            } else {
                $this->error('删除失败！');
            }
        } else {
            $this->error('非法操作！');
        }
    }

}
