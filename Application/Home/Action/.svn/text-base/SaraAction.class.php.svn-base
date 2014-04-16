<?php

namespace Home\Action;
use \Think\Action;

/**
 * 刘二妹的那些事 控制器
 */
class SaraAction extends CommonAction {

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
		$this->display();
	}

	/**
	 * 瀑布流获取图片
	 * @return [type] [description]
	 */
	function loadPic() {
		IS_POST || throw_exception('您访问的页面不存在！');
		$num = I('num', '', 'intval');
		$start = I('start', '', 'intval');
		$sql = 'select id from `sara_pic` limit ' . $start . ', ' . $num;
		$data = M()->query($sql);
		if (empty($data)) exit(json_encode(array('status' => 'none')));
		exit(json_encode($data));
	}
}