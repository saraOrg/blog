<?php

namespace Home\Action;

use \Think\Action;

/**
 * 技术分享控制器
 */
class TechnologyShareAction extends CommonAction {

    /**
     * 首页前置方法，显示菜单
     * @return [type] [description]
     */
    public function _before_index() {
        $this->showMenu();
    }

    /**
     * 显示首页
     * @return [type] [description]
     */
    public function index() {
        $tag = array($_GET['tag'] ? : 'index');
        if ($tag[0] === 'index') {
            $tag = getCTags(CONTROLLER_NAME);
        }
        $count           = M('Article')->where(array('code' => array('IN', $tag)))->order('create_date DESC')->count();
        $page            = new \Think\Page($count, 10);
        $limit           = $page->firstRow . ',' . $page->listRows;
        $this->article   = M('Article')->where(array('code' => array('IN', $tag)))->limit($limit)->order('create_date DESC')->select();
        //过滤掉路由时候的多余参数
        $page->parameter = array('p' => $_GET['p']);
        $page->setConfig('prev', '上一页');
        $page->setConfig("next", '下一页');
        //这里自定义一下分页的链接
        $this->url       = '/' . CONTROLLER_NAME . '/' . (($_GET['tag'] === NULL) ? 'index' : $_GET['tag']) . '/';
        $page->setConfig('theme', '%FIRST% 第 %NOW_PAGE% 页, 共 %TOTAL_PAGE% 页end %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $this->page      = str_replace(array('第', '页end'), array('<span>第', '页</span>'), $page->show($this->url));
        $this->display();
    }

}
