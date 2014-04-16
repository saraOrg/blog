<?php

namespace Admin\Action;
use \Common\Action\CommonAction;

/**
 * 心情随笔 控制器
 */

class CFreeAction extends CommonAction {

	/**
	 * 添加
	 */
	public function add() {
		$this->action = 'insert';
		$data = include APP_PATH . '/Home/Conf/menu.php';
		array_shift($data[2]['tags']);
		$this->tags = $data[2]['tags'];
		parent::add('free');
	}

	/**
	 * 编辑
	 */
	public function edit() {
		$this->action = 'update';
		$data = include APP_PATH . '/Home/Conf/menu.php';
		array_shift($data[2]['tags']);
		$this->tags = $data[2]['tags'];
		parent::edit(NULL, 'free');
	}
}