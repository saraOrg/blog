<?php

namespace Admin\Model;

/**
 * =================================================
 * Description of SysUserModel
 * ================================================
 * @category happy
 * @package Admin/
 * @subpackage Action
 * @author Happy <yangbai6644@163.com>
 * @dateTime 2013-12-29 17:21:34
 * ================================================
 */
class SysUserModel extends \Common\Model\CommonModel {
    
    //用户id标识
    protected $uid = 0;

    /**
     * 数据自动完成
     * @var type 
     */
    protected $_auto = array(
        array('user_id', 'getMaxUid', self::MODEL_INSERT, 'callback'),
        array('password', 'password', self::MODEL_BOTH, 'callback'),
    );
    
    /**
     * 获取最大序列号作为用户的id
     * @return type
     */
    protected function getMaxUid() {
        $this->uid = getSequence('sys_user', 'user_id', 10001);
        return $this->uid;
    }

    /**
     * 插入后置方法,处理附加的添加信息
     * @param type $data
     * @param type $options
     */
    protected function _after_insert($data, $options) {
        parent::_after_insert($data, $options);
        if (empty($this->uid) && isset($_POST[$this->getPk()])) {
            $this->uid = $_POST[$this->getPk()];
        }
        $this->SyncUnionData();
    }

    /**
     * 更新后置方法，处理附加的更新信息
     * @param type $data
     * @param type $options
     */
    protected function _after_update($data, $options) {
        parent::_after_update($data, $options);
        if (empty($this->uid) && isset($_POST[$this->getPk()])) {
            $this->uid = $_POST[$this->getPk()];
        }
        $this->SyncUnionData();
    }

    /**
     * 更新用户所属角色信息
     */
    protected function updateRole() {
        $data = array();
        foreach ($_POST['role_id'] as $value) {
            $data[] = array(
                'user_id' => $this->uid,
                'role_id' => $value,
            );
        }
        M('SysRoleUser')->where(array('user_id' => $this->uid))->delete();
        empty($data) or M('SysRoleUser')->addAll($data);
    }

    /**
     * 批量更新附加信息，保证信息同步
     */
    protected function SyncUnionData() {
        $this->updateRole();
    }
    
    /**
     * 删除用户时删除附加信息
     * @param type $ids
     */
    public function foreverdelete($ids) {
        $this->uid = array('in', $ids);
        $this->SyncUnionData();
    }
    
    /**
     * 输入密码处理
     * @return boolean
     */
    protected function password() {
        //默认用md5加密
        if (isset($_POST['password']) && $_POST['password'] !== '') {
            return md5($_POST['password']);
        } else {
            //编辑的时候为空表示更改
            unset($_POST['password']);
            return false;
        }
    }

}
