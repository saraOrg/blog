<?php

/**
 * =================================================
 * 基于角色的数据库方式验证类
 * ================================================
 * @category Happy
 * @package Common/Util
 * @subpackage none
 * @author Happy <yangbai6644@163.com>
 * @dateTime 2013/12/23 21:06:00
 * ================================================
 */

namespace Common\Util;

class RBAC {

    /**
     * 认证方法
     * @param type $map
     * @param type $model
     * @return type
     */
    static public function authenticate($map, $model = '') {
        empty($model) && $model = D(C('USER_AUTH_MODEL'));
        /* 使用给定的$map条件进行认证 */
        return $model->where($map)->find();
    }

    /**
     * 保存权限列表
     * @param type $authId
     * @return type
     */
    static public function saveAccessList($authId = null) {
        is_null($authId) && $authId = C('USER_AUTH_KEY');
        /**
         * 普通权限模式，保存权限列表到session中
         * 管理员开发所有权限
         * 实时验证直接到数据库中去验证，无需保存session
         */
        if (C('USER_AUTH_TYPE') != 2 && !$_SESSION[C('ADMIN_AUTH_KEY')]) {
            $_SESSION['_ACCESS_LIST'] = self::getAccessList($authId);
        }
        return;
    }

    static public function checkAccess() {
        /*
         * 如果项目要求认证，并且当前模块需要认证，则进行权限认证 
         * 这里如果再细分权限的话，可以继续再判断分组（3.1）/模块（3.2）得需要认证情况
         */
        if (C('USER_AUTH_ON')) {
            $_model = array();
            $_action = array();
            if ('' != C('REQUEST_AUTH_MODEL')) {
                //配置了需要认证的模块就不需要配置不需要认证的模块，其他都不需要认证
                $_model['yes'] = explode(',', strtoupper(C('REQUEST_AUTH_MODEL')));
            } else {
                //配置了不需要认证的模块列表，其他都需要认证
                $_model['no'] = explode(',', strtoupper(C('NOT_AUTH_MODEL')));
            }
            if ((!empty($_model['no']) && !in_array(strtoupper(CONTROLLER_NAME), $_model['no'])) || (!empty($_model['yes']) && in_array(strtoupper(CONTROLLER_NAME), $_model['yes']))) {
                if ('' != C('REQUEST_AUTH_ACTION')) {
                    //需要认证的操作
                    $_action['yes'] = explode(',', C('REQUEST_AUTH_MODEL'));
                } else {
                    //无需认证的操作
                    $_action['no'] = explode(',', C('NOT_AUTH_MODEL'));
                }
                if ((!empty($_action['no']) && !in_array(strtoupper(ACTION_NAME), $_action['no'])) || (!empty($_action['yes']) && in_array(strtoupper(ACTION_NAME), $_action['yes']))) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        return false;
    }

    /**
     * 查询系统权限缓存表获取用户的权限
     * @staticvar array $data
     * @param type $authId
     * @return type
     */
    static public function getAccessList($authId) {
        static $data = array();
        if (empty($data)) {
            $db = Db::getInstance(C('RBAC_DB_DSN'));
            $authInfo = $db->query('SELECT * from sys_access_cache where uid = "' . $authId . '"');
            $data = array();
            foreach ($authInfo as $key => $value) {
                $data[] = strtoupper($value['auth']);
            }
        }
        return $data;
    }

    static public function accessDecision() {
        if (self::checkAccess()) {
            if (empty($_SESSION[C('ADMIN_AUTH_KEY')])) {
                if (2 == C('USER_AUTH_TYPE')) {
                    $accessList = RBAC::getAccessList($_SESSION[C('USER_AUTH_KEY')]);
                }else {
                    //登录验证模式
                    $accessList = $_SESSION['_ACCESS_LIST'];
                }
                if (in_array(strtoupper(MODULE_NAME). '/' . strtoupper(CONTROLLER_NAME) . '/'. strtoupper(ACTION_NAME), $accessList)) {
                    return true;
                }else {
                    return false;
                }
            } else {
                //管理员无需认证
                return true;
            }
        } else {
            return true;
        }
    }

    /**
     * 更新权限缓存表
     */
    static public function updateAccess() {
        
    }

}
