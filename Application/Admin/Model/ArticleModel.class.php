<?php

namespace Admin\Model;
use \Common\Model\CommonModel;

/**
 * 博文模型
 */

class ArticleModel extends CommonModel {

	/**
	 * 自动验证
	 */
	protected $_validate = array(
		array('title', 'require', '博文标题不能为空哦', 0),
		array('cid', 'require', '博文分类不能为空哦', 0),
		array('content', 'checkContent', '博文内容不能为空哦', 0, 'function', 0),
	);

	/**
	 * 自动完成
	 */
	protected $_auto = array(
		array('create_date','time',1,'function'),
	);
}