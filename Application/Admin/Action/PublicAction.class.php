<?php

namespace Admin\Action;

use Think\Action;
use Think as verify;

class PublicAction extends Action {

    /**
     * 显示登录页面
     */
    public function login() {
        $this->display();
    }

    /**
     * 生成验证码方法
     */
    public function verify() {
        $verify = new verify\Verify();
        $verify->entry(1988);
    }

    /**
     * 登录验证
     */
    public function check_login() {
        if (IS_AJAX) {
            //调用service方法实例化service类验证
            $this->ajaxReturn(service());
        } else {
            throw_exception('无法访问此模块！');
        }
    }
    
    /**
     * 用户退出登录方法
     */
    public function logout() {
        $_SESSION = array();
        session_unset();
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 3600, '/');
        }
        session_destroy();
        $this->success('成功退出登录！');
    }

}
