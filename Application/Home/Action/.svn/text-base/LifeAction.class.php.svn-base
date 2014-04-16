<?php

namespace Home\Action;

use Think\Action;

/**
 * 我的生活 控制器
 */
class LifeAction extends CommonAction {

    /**
     * 首页前置方法
     */
    public function _before_index() {
        $this->showMenu();
    }

    /**
     * 显示首页
     */
    public function index() {
        $code = $_GET['tag'] ? : 'index';
        $tags = array();
        if ($code == 'index') {
            $tags = getCTags(CONTROLLER_NAME);
        } else {
            $tags[] = $code;
        }
        $this->article = M('Article')->where(array('code' => array('IN', $tags)))->select();
        $this->display();
    }

}
