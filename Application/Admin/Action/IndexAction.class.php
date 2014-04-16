<?php

namespace Admin\Action;

use Common\Action\CommonAction;

class IndexAction extends CommonAction {

    /**
     * 显示首页
     */
    public function index() {
        parent::index(NULL, 'default', NULL);
    }

    public function main() {
        $this->theme('blue')->display();
    }

    public function left() {
        $menu = include APP_PATH . 'Admin/Conf/menu_list.php';
        $datas = array();
        foreach ($menu as $value) {
            $data = array();
            $data['name'] = $value['name'];
            foreach ($value['children'] as $val) {
                $data['son'][] = array(
                    'name'  =>  $val['name'],
                    'url'   =>  U('/' . $val['f_code'] . '/index'),
                );
            }
            $datas[] = $data;
        }
        $this->ajaxReturn($datas);
    }

    /**
     * 文件下载
     */
    public function download() {
        //service处理下载
        service();
    }

}
