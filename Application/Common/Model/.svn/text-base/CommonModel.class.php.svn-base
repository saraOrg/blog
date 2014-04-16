<?php

namespace Common\Model;
use \Think\Model;
/**
 * =================================================
 * 公共模型类
 * ================================================
 * @category happy
 * @package Admin/
 * @subpackage Action
 * @author Happy <yangbai6644@163.com>
 * @dateTime 2013-12-26 22:39:41
 * ================================================
 */
class CommonModel extends Model{
    /**
     * 根据主键获取一条记录
     * @param type $pk
     * @return type
     */
    public function getOneByPk($pk) {
        return $this->where(array($this->getPk()=>$pk))->find();
    }
}
