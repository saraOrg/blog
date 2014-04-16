<?php

namespace Home\Action;

use \Think\Action;

/**
 * 心情随笔 控制器
 */
class FreeAction extends CommonAction {

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
        if (isset($_GET['method']) && $_GET['method'] === 'zan') {
            $this->_zan();
        } else {
            $tag = $_GET['tag'] ? : '';
            if ($tag == 'index' || $tag == '') {
                $where = '';
            } else {
                $where = array('code' => $tag);
            }
            $this->free = M('CFree')->where($where)->order('send_date DESC')->select();
            $this->display();
        }
    }

    //处理心情赞请求
    private function _zan() {
        if (!empty($_POST['id'])) {
            //赞
            if ($_POST['isZan'] === 'true') {
                if (FALSE !== M('CFree')->where(array('id' => $_POST['id']))->setInc('zan')) {
                     $this->success('赞成功！');
                } else {
                     $this->error('赞失败！');
                }
            } else {
                //取消赞
                 if (FALSE !== M('CFree')->where(array('id' => $_POST['id']))->setDec('zan')) {
                     $this->success('取消赞成功！');
                } else {
                     $this->error('取消赞失败！');
                }
            }
        }
    }

}
