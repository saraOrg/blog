<?php

namespace Home\Action;

use \Think\Action;

/**
 * 博文内容页 控制器
 */
class ContentAction extends CommonAction {

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
        //第一次阅读的时候次数+1丙记录阅读时间
        if (!session('last_views_time' . $_REQUEST['id'])) {
             M('Article')->where(array('id' => $_REQUEST['id']))->setInc('views');
            //记录上一次阅读时间
            session('last_views_time' . $_REQUEST['id'], time());
        }
        //非第一次阅读，1小时之后阅读次数+1
        if (session('last_views_time' . $_REQUEST['id']) && time() - session('last_views_time' . $_REQUEST['id']) > 3600) {
            M('Article')->where(array('id' => $_REQUEST['id']))->setInc('views');
            //记录上一次阅读时间
            session('last_views_time' . $_REQUEST['id'], time());
        }
        $this->controller_name = \getParentCode($_GET['tag']);
        $this->vo = M('Article')->where(array('id' => $_REQUEST['id']))->find();
        $this->display();
    }

}
