<?php

namespace Home\Action;

use Home\Action\CommonAction;

/**
 * =================================================
 * Description of SearchAction
 * ================================================
 * @category happy
 * @package Admin/
 * @subpackage Action
 * @author Happy <yangbai6644@163.com>
 * @dateTime 2014-3-1 13:43:02
 * ================================================
 */
class SearchAction extends CommonAction {

    /**
     * 首页前置方法
     */
    public function _before_index() {
        $this->showMenu();
    }

    public function index() {
        if ($_POST['type'] == 0) {
            $where        = array(
                array('title' => array('LIKE', '%' . $_POST["keywords"] . '%')),
                array('content' => array('LIKE', '%' . $_POST["keywords"] . '%')),
                '_logic' => 'OR'
            );
            $article      = M('Article')->where($where)->select();
            $where        = array(
                array('content' => array('LIKE', '%' . $_POST["keywords"] . '%')),
                '_logic' => 'OR'
            );
            $free         = M('CFree')->where($where)->select();
            //p($free);
            $this->result = array_merge($article, $free);
            $count        = !empty($this->result) ? count($this->result) : '0';
            $this->info   = '总共搜索到相关信息' . $count . '条！';
        } else {
            switch ($_POST['type']) {
                //技术
                case '1':
                    $model          = 'Article';
                    $tag            = 'TechnologyShare';
                    $where          = array(
                        array('title' => array('LIKE', '%' . $_POST["keywords"] . '%')),
                        array('content' => array('LIKE', '%' . $_POST["keywords"] . '%')),
                        '_logic' => 'OR'
                    );
                    $this->typename = '技术';
                    break;
                //心情
                case '2':
                    $model          = 'CFree';
                    $tag            = 'index';
                    $where          = array(
                        array('content' => array('LIKE', '%' . $_POST["keywords"] . '%')),
                        '_logic' => 'OR'
                    );
                    $this->typename = '心情';
                    break;
                //生活
                case '3':
                    $model          = 'Life';
                    $tag            = 'index';
                    $this->typename = '生活';
                    break;
                //工作
                case '4':
                    $model          = 'JOb';
                    $tag            = 'index';
                    $this->typename = '工作';
                    break;
            }
            $this->result = M($model)->where($where)->select();
            $count        = !empty($this->result) ? count($this->result) : '0';
            $this->info   = '总共搜索到<strong>' . $this->typename . '</strong>相关信息' . $count . '条！';
        }
        $this->display();
    }

}
