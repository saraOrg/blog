<?php

namespace Admin\Service;
use Think\Action;

/**
 * Description of AdminService
 *
 * @author Happy <yangbai6644@163.com>
 * @date 2013-12-20 19:20:21
 */
class AdminService extends Action{

    /**
     * 返回默认格式的数组
     * @param type $status
     * @param type $message
     * @param type $url
     * @return type
     */
    private function _returnArray($status, $message, $url = '') {
        return array('status' => $status, 'info' => $message, 'url' => $url);
    }

    /**
     * 验证用户登录
     * @return type
     */
    public function check_login() {
        if (1 === session('login_error_flag') && empty($_POST['verify'])) {
            return $this->_returnArray(0, '验证码必须！');
        } elseif (empty($_POST['login_name'])) {
            return $this->_returnArray(0, '用户名必须！');
        } elseif (empty($_POST['password'])) {
            return $this->_returnArray(0, '登录密码必须！');
        }
        //出现登录失败后显示验证码
        if (1 === session('login_error_flag')) {
            if (false === check_verify($_POST['verify'])) {
                return $this->_returnArray(0, '验证码不正确！');
            }
        }
        //数据库验证用户名
        $user1 = M('SysUser')->where(array('login_name' => $_POST['login_name']))->find();
        if (empty($user1)) {
            //更新用户登录错误标志
            session('login_error_flag', 1);
            return $this->_returnArray(0, '用户名不存在！');
        }

        /**
         * 锁定和登录错误数判断
         */
        //读取系统配置的用户登录错误次数最大值
        $login_error_count = C('LOGIN_ERROR_COUNT');
        //读取系统配置的用户锁定时间值
        $user_lock_time = C('USER_LOCK_TIME');
        //判断用户是否锁定
        if (1 === intval($user1['is_lock'])) {
            //锁定时间到了清除锁定
            if ((time() - intval($user1['lock_time'])) >= $user_lock_time) {
                $user1['is_lock'] = 0;
                $user1['login_error_count'] = 0;
                M('SysUser')->where(array('user_id' => $user1['user_id']))->save($user1);
            } else {
                $times = intval($user1['lock_time']);
                $times += $user_lock_time;
                $now = time();
                return $this->_returnArray(0, '用户已锁定，请' . ($times - $now) . 's后再尝试！');
            }
        }
        //判断用户是否有权限
        //数据库验证密码
        $user2 = M('SysUser')->where(array('login_name' => $_POST['login_name'], 'password' => md5($_POST['password'])))->find();
        //登录密码不正确，记录一次，超过限定值锁定用户
        if (empty($user2)) {
            //更新用户登录错误标志
            session('login_error_flag', 1);
            //密码错误次数超过限制，锁定用户一段时间
            if (intval($user1['login_error_count']) >= $login_error_count) {
                $user1['is_lock'] = 1;
                $user1['lock_time'] = time();
                M('SysUser')->where(array('user_id' => $user1['user_id']))->save($user1);
                return $this->_returnArray(0, '登录失败次数超过限制，用户已锁定，请' . (intval($user1['lock_time']) + $user_lock_time - time()) . 's后再尝试！');
            } else {
                //记录用户登录密码错误的次数
                M('SysUser')->where(array('user_id' => $user1['user_id']))->setInc('login_error_count');
                return $this->_returnArray(0, '登录密码不正确，您还有' . ($login_error_count - intval($user1['login_error_count'])) . '次机会尝试！');
            }
        }
        /**
         * 登录成功,保存/清除相关信息
         */
        //清空登录失败标志
        session('login_error_flag', '');
        //保存相关信息到session
        $data = array(
            'uid' => $user2['user_id'],
            'login_name' => $user2['login_name'],
            'full_name' => $user2['full_name'],
            'login_tiem' => time(),
            'login_ip' => get_client_ip(),
            'login_error_count' => 0,
        );
        session('user', $data);
        //保存用户认证标识
        session(C('USER_AUTH_KEY'), $data['uid']);
        /**
         * 系统管理员登录，记录session标识
         */
        $data['login_name'] === 'admin' && \session('administrator', true);
        //更新用户信息
        M('SysUser')->where(array('user_id' => $data['uid']))->save($data);
        //缓存RBAC权限
        \Think\RBAC::saveAccessList();
        //返回登录成功要转向的url
        return $this->_returnArray(1, '登录成功！', U('Index/index'));
    }

    public function download() {
        //根据下载的id号查询要下载的文件信息
        $file_id = $_GET['user_id'];
        //文件不存在跳转到首页
        in_array($file_id, array('1', '2')) or $this->error('文件不存在或者已删除', U("/"));
        $file_path = 'D:\myEnv\wamp\www\demo\Resource\web-2013-12-19.7z';
        file_exists($file_path) or exit('不存在或者已删除！');
        $file_name = 'sofreight.7z';
        $file_size = filesize($file_path);
        $info = pathinfo($file_path);
        $file_type = $info['extension'];
        //重设响应类型
        header("Content-Type:" . $file_type);
        //执行下载文件时显示的文件名
        header("Content-Disposition:attachment;filename=" . $file_name);
        //指定下载文件的大小
        header("Content-Length:" . $file_size);
        readfile($file_path);
        exit();
    }

}
