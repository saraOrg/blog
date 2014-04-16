<?php

namespace Admin\Model;
use \Common\Model\CommonModel;

/**
 * 心情随笔 模型
 */

class CFreeModel extends CommonModel {
	
	/**
	 * 自动完成
	 */
	protected $_auto = array(
		array('send_date', 'time', 1, 'function'),
	);
}