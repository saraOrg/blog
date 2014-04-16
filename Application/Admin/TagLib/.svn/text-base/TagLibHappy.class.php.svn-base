<?php

namespace Admin\TagLib;
use Think\Template\TagLib;

define('SARA') or exit();

/**
 * Description of TagLibHappy
 *
 * @author Happy <yangbai6644@163.com>
 * @date 2013-12-24 21:59:15
 */
class TagLibHappy extends TagLib{
    protected $tags = array(
        // 标签定义： attr 属性列表 close 是否闭合（0 或者1 默认1） alias 标签别名 level 嵌套层次
        'list' => array('attr'=>'id,pk,style,action,actionlist,show,datasource,checkbox','close'=>0),
    );
    
    protected function _list($tag) {
        \p($tag);
    }
}
