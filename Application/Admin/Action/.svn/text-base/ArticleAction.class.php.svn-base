<?php

namespace Admin\Action;

/**
 * Description of ArticleAction
 *
 * @author Happy <yangbai6644@163.com>
 * @date 2013-12-24 20:41:11
 */
class ArticleAction extends \Common\Action\CommonAction {
    
    /**
     * 初始化方法
     */
    public function _initialize() {
        parent::_initialize();
         C('SHOW_PAGE_TRACE', false);
    }

    public function index() {
        parent::index(NULL, 'default', NULL);
    }

    /**
     * 添加
     * @return [type] [description]
     */
    public function add() {
        C('SHOW_PAGE_TRACE', false);
        $this->action = 'insert';
        $data         = include APP_PATH . '/Home/Conf/menu.php';
        array_shift($data);
        $this->assign('cate', $data);
        $this->theme('default')->display('article');
    }

    /**
     * 编辑
     * @return [type] [description]
     */
    public function edit() {
        $this->action = 'update';
        $data         = include APP_PATH . '/Home/Conf/menu.php';
        array_shift($data);
        $this->assign('cate', $data);
        parent::edit(NULL, 'default', 'article');
    }

    public function _filter(&$map) {
        if (isset($_POST['code']) && !empty($_POST['code'])) {
            $map['code'] = array('LIKE', '%' . $_POST['code'] . '%');
        }
        if (isset($_POST['title']) && !empty($_POST['title'])) {
            $map['title'] = array('LIKE', '%' . $_POST['title'] . '%');
        }
    }

}
