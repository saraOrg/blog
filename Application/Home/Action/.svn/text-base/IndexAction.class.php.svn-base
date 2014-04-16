<?php

namespace Home\Action;

use Think\Action;

/**
 * 前台首页控制器
 */
class IndexAction extends CommonAction {

    /**
     * 首页前置方法，初始化数据
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
        $count     = M('Article')->count();
        $page      = new \Think\Page($count, 10);
        $i         = '';
        $list_page = array();
        for ($i = ceil($count / 10); $i >= 1; $i--) {
            $list_page[$i] = '第&nbsp;' . $i . '&nbsp;页';
        }
        $now_page      = $_GET['p'] ? : '1';
        $prev          = $now_page > 1 ? : false;
        $next          = $now_page < count($list_page) ? : false;
        $this->assign('list_page', $list_page);
        $this->assign('prev_page', $now_page - 1);
        $this->assign('now_page', $now_page);
        $this->assign('next_page', $now_page + 1);
        $this->assign('prev', $prev);
        $this->assign('next', $next);
        $limit         = $page->firstRow . ', ' . $page->listRows;
		$this->article =  M('Article')->Field('content', true)->order('create_date DESC')->limit($limit)->select();
        $this->page    = $page->show();
        $this->display();
    }
    
    /**
     * 首页后置方法，更新访客记录
     */
    public function _after_index() {
//        $data  = array();
//        $model = M('ReVisitors');
//        $ip    = get_client_ip();
//        if ($model->where(array('ip' => $ip))->find()) {
//            $data['vs_date'] = time();
//            $model->where(array('ip' => $ip))->save($data);
//        } else {
//            $ipHelper         = new \Org\Net\IpLocation();
//            $location         = $ipHelper->getlocation($ip);
//            $data['ip']       = $ip;
//            $data['location'] = $location['country'];
//            $data['vs_date']  = time();
//            $model->add($data);
//        }
    }

}
