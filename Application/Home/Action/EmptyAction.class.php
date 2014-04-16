<?php

namespace Home\Action;
use \Think\Action;

/**
 * =================================================
 * 前台空控制器
 * ================================================
 * @category happy
 * @package Admin/
 * @subpackage Action
 * @author Happy <yangbai6644@163.com>
 * @dateTime 2014-3-10 21:01:39
 * ================================================
 */
class EmptyAction extends Action {
    
    /**
     * 空控制器操作,直接跳转到首页
     */
    public function index() {
        redirect(U('/'));
    }
}
