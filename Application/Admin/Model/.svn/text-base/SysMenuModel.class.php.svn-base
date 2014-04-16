<?php

namespace Admin\Model;

/**
 * =================================================
 * Description of SysMenuModelModel
 * ================================================
 * @category happy
 * @package Admin/
 * @subpackage Action
 * @author Happy <yangbai6644@163.com>
 * @dateTime 2014-1-3 22:03:20
 * ================================================
 */
class SysMenuModel extends \Common\Model\CommonModel {

    /**
     * 根据菜单列表返回zTtree格式的数据
     * @return array
     */
    public function getTreeData() {
        $nodes   = array();
        //初始化根节点数据
        $nodes[] = array('id' => 0, 'pid' => 0, 'name' => '菜单列表', 'open' => true, 'nocheck' => true);
        $menu_list = include(APP_PATH.'Admin/Conf/menu_list.php');
        return json_encode($menu_list);
        return $nodes;
    }

}
