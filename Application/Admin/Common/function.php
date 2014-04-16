<?php

/**
 * =================================================
 * 项目后台基础函数库文件
 * =================================================
 * 用于定义项目常用的基础函数
 * ================================================
 * @category Happy
 * @package Happy
 * @subpackage Happy/Common
 * @author Happy <yangbai6644@163.com>
 * @dateTime 2014-1-5 00:33:20
 * ================================================
 */

/**
 * 显示任务类型
 * @param type $type
 * @return string
 */
function displayType($type) {
    switch ($type) {
        case '0':
            return '新建';
        case '1':
            return '审核';
        case '2':
            return '正在处理';
    }
}

/**
 * 显示数据字典类型
 * @param type $type_id
 * @return type
 */
function displayCodeType($type_id) {
    //return M('SysCodeType')->where(array('type_id'=>$type_id))->getField('type_remark');
    return getFieldByTable('type_remark', 'type_id', $type_id, 'SysCodeType');
}

/**
 * 递归方式把节点数据按照层级关系组装成一维数组
 * @param type $node_list
 * @param type $pid
 * @return type
 */
function recursionNode($node_list, $pid = 0) {
    $data = array();
    foreach ($node_list as $value) {
        if ($value['pid'] == $pid) {
            $value['child'] = recursionNode($node_list, $value['id']);
            $data[]         = $value;
        }
    }
    return $data;
}

/**
 * 递归方式把节点数据按照层级关系组装成二维数组
 * @param type $node_list
 * @param type $pid
 * @return type
 */
function recursion2Node($node_list, $pid = 0) {
    $data = array();
    foreach ($node_list as $value) {
        if ($value['pid'] == $pid) {
            $value['pad'] = str_repeat("|--", $value['level'] - 1);
            $data[]       = $value;
            $data         = array_merge($data, recursion2Node($node_list, $value['id']));
        }
    }
    return $data;
}

/**
 * 后台权限验证方法
 * @staticvar array $accessList
 * @param type $authPath
 * @param type $admin
 * @return boolean
 */
function checkAuth($authPath, $admin = true) {
    $data           = explode('/', $authPath);
    $moduleName     = strtoupper($data[0]);
    $controllerName = strtoupper($data[1]);
    $actionName     = strtoupper($data[2]);
    //如果是admin，则无需认证
    if ($admin && session(C('ADMIN_AUTH_KEY')) === TRUE) {
        return true;
    }
    static $accessList = array();
    if (empty($accessList)) {
        //非开发模式下从session中获取权限列表
        if (FALSE === APP_DEBUG && isset($_SESSION['_ACCESS_LIST'])) {
            $accessList = $_SESSION['_ACCESS_LIST'];
        } else {
            session(C('USER_AUTH_KEY')) && $accessList = \Think\RBAC::getAccessList(session(C('USER_AUTH_KEY')));
        }
    }
    return isset($accessList[$moduleName][$controllerName][$actionName]);
}

/**
 * 根据分类code显示分类名称
 * @param  [type] $code [description]
 * @return [type]       [description]
 */
function getCategoryName($code) {
    $data = include APP_PATH . '/Home/Conf/menu.php';
    foreach ($data as $value) {
        if (isset($value['tags'])) {
            foreach ($value['tags'] as $val) {
                if ($val['tag_code'] == $code) {
                    return $val['name'];
                }
            }
        }
    }
}

/**
 * 显示博文简短的概要
 * @param  [type] $value [description]
 * @return [type]        [description]
 */
function showSimpleSummary($value) {
    if (mb_strlen($value, 'UTF-8') > 30) {
        return mb_substr($value, 0, 30, 'UTF-8') . '<span style="color:blue;margin-left:2px">....</span>';
    }
    return $value;
}

/**
 * 显示文章logo图片
 * @param type $value
 * @return string
 */
function display_article_logo($value) {
    if (!empty($value)) {
        return '<a href="' . __ROOT__ . '/Uploads' . $value . '" target="_blank">查看原图</a>';
    } else {
        return '暂无';
    }
}
