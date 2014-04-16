<?php

namespace Admin\Action;

/**
 * =================================================
 * Description of sysCodeAction
 * ================================================
 * @category happy
 * @package Admin/
 * @subpackage Action
 * @author Happy <yangbai6644@163.com>
 * @dateTime 2013-12-29 11:25:03
 * ================================================
 */
class SysCodeAction extends \Common\Action\CommonAction {
    
    /**
     * 显示添加页面
     */
    public function add() {
        $this->codeType = M('SysCodeType')->select();
        $this->action = 'insert';
        $this->display('sysCode');
    }
    
    /**
     * 显示编辑页面
     */
    public function edit() {
        $this->codeType = M('SysCodeType')->select();
        $this->action = 'update';
        parent::edit(NULL, 'sysCode');
    }
}
