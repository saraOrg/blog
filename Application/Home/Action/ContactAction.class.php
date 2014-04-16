<?php

namespace Home\Action;
use Think\Action;

/**
 * 关于&留言 控制器
 */

class ContactAction extends CommonAction {

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
}