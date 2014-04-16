<?php

namespace Admin\Action;

/**
 * =================================================
 * 系统数据字典类型
 * ================================================
 * @category happy
 * @package Admin/
 * @subpackage Action
 * @author Happy <yangbai6644@163.com>
 * @dateTime 2013-12-26 22:06:58
 * ================================================
 */
class SysCodeTypeAction extends \Common\Action\CommonAction {

    public function _before_index() {
        //设置排序字段，支持多字段，规则和sql语句一样
        val('_order', 'seq_code ASC');
    }

    /**
     * 显示添加页面
     */
    public function add() {
        $this->action = 'insert';
        parent::add('codeType');
    }

    /**
     * 显示添加页面
     */
    public function edit() {
        $this->action = 'update';
        parent::edit(NULL, 'codeType');
    }

}
