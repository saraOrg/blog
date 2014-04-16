<?php

namespace Home\Action;

use \Think\Action;

/**
 * 前台公共控制器
 */
class CommonAction extends Action {

    /**
     * 初始化方法
     */
    public function _initialize() {
        $this->_getCommonInfo();
    }

    /**
     * 显示菜单
     */
    public function showMenu() {
        $this->module_name     = MODULE_NAME;
        $this->controller_name = CONTROLLER_NAME;
        $this->action_name     = ACTION_NAME;
        $this->action          = $_GET['action'];
        $this->menu_list       = include APP_PATH . MODULE_NAME . '/Conf/menu.php';
        $hottags               = array(
            array('name' => 'PHP', 'code' => 'php', 'model' => 'Article', 'style' => 'color:#42288c;font-size: 14.4615384615pt;'),
            array('name' => 'MYSQL', 'code' => 'mysql', 'model' => 'Article', 'style' => 'color:#684aeb;font-size: 11.8769230769pt;'),
            array('name' => 'LINUX', 'code' => 'linux', 'model' => 'Article', 'style' => 'color:#fefda2;font-size: 11.8769230769pt;'),
            array('name' => 'JAVASCRIPT', 'code' => 'javascript', 'model' => 'Article', 'style' => 'color:#16c161;font-size: 9pt;'),
            array('name' => 'PYTHON', 'code' => 'python', 'model' => 'Article', 'style' => 'color:#cd57e3;font-size: 8pt;'),
            array('name' => 'C/C++', 'code' => 'ccpp', 'model' => 'Article', 'style' => 'color:#e8babe;font-size: 19.8461538462pt;'),
            array('name' => 'ORACLE', 'code' => 'oracle', 'model' => 'Article', 'style' => 'color:#944338;font-size: 11.8769230769pt;'),
            array('name' => '开心', 'code' => 'happy', 'model' => 'CFree', 'style' => 'color:#739b09;;font-size: 13pt;'),
            array('name' => '激动', 'code' => 'pat', 'model' => 'CFree', 'style' => 'color:#c970ad;;font-size: 15pt;'),
            array('name' => '烦躁', 'code' => 'gordon', 'model' => 'CFree', 'style' => 'color:#61e9ed;;font-size: 11pt;'),
            array('name' => '悲伤', 'code' => 'sad', 'model' => 'CFree', 'style' => 'color:#7be46c;;font-size: 9pt;'),
            array('name' => '呵呵', 'code' => 'hehe', 'model' => 'Article', 'style' => 'color:#944338;font-size: 11pt;'),
            array('name' => '哈哈', 'code' => 'haha', 'model' => 'Article', 'style' => 'color:#88fb73;font-size: 13pt;'),
            array('name' => '嘿嘿', 'code' => 'heihei', 'model' => 'Article', 'style' => 'color:#004bf7;font-size: 19pt;'),
            array('name' => '呜呜', 'code' => 'wuwu', 'model' => 'Article', 'style' => 'color:#26ab19;font-size: 9pt;'),
            array('name' => '刘二妹的那些事', 'code' => 'sara', 'model' => 'Article', 'style' => 'color:#ef06b8;font-size: 8;'),
        );
        foreach ($hottags as $value) {
            $html .= '<a href="' . U('/') . getParentCode($value['code']) . '/' . $value['code'] . '" title="' . getArticleNumsByTag($value['model'], $value['code']) . '篇文章" style="' . $value['style'] . '">' . $value['name'] . '</a>' . "\n";
        }
        $this->hottags = $html;
    }

    /**
     * 获取首页公共显示信息
     */
    private function _getCommonInfo() {
        //获取右边导航栏的最新/热门/随机
        if (!S('newest_blog')) {
            S('newest_blog', M('Article')->order('create_date DESC')->limit(10)->Field('title')->select(), 60 * 60);
        }
        $this->newest = S('newest_blog');
        if (!S('hot_blog')) {
            S('hot_blog', M('Article')->order('views DESC')->limit(10)->Field('title')->select(), 60 * 60);
        }
        $this->hot = S('hot_blog');
        if (!S('random_blog')) {
            S('random_blog', M('Article')->order('rand()')->limit(10)->Field('title')->select(), 60 * 60);
        }
        $this->random = S('random_blog');
        //获取最近访客
        //$this->visitors = M('ReVisitors')->order('`vs_date` DESC')->limit(10)->select();
    }

}
