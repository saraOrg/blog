<?php

namespace Common\Controller;

/**
 * =================================================
 * 系统插件类
 * ================================================
 * @category happy
 * @package Admin/
 * @subpackage Action
 * @author Happy <yangbai6644@163.com>
 * @dateTime 2014-3-29 21:31:10
 * ================================================
 */
abstract class Plugin {

    function __construct() {
        $this->view = \Think\Think::instance('Think\View');
        $this->plugin_path = '../Plugins/' . $this->_getPluginName() . '/';
        $this->tpl_ext = '.html';
    }
    
    public function _getPluginName() {
        return substr(get_class($this), strrpos(get_class($this), '\\')+1, -6);
    }
    
    final public function assign($name, $value = '') {
        $this->view->assign($name, $value);
        return $this;
    }
    
    final public function display($tpl) {
        $this->view->display($this->plugin_path . $tpl . $this->tpl_ext);
    }
    
    abstract public function install();
    
    abstract public function uninstall();

}
