<?php

namespace Common\Behavior;

use Think\Behavior;

/**
 * =================================================
 * 初始化钩子行为
 * ================================================
 * @category happy
 * @package Admin/
 * @subpackage Action
 * @author Happy <yangbai6644@163.com>
 * @dateTime 2014-3-29 21:32:40
 * ================================================
 */
class InitHookBehavior extends Behavior {

    /**
     * 行为必须实现run方法
     */
    public function run(&$arg) {
        if (S('plugin_list')) {
             $data = S('plugin_list');
             \Think\Hook::import($data);
        } else {
            $hook = C('PLUGIN_LIST');
            foreach ($hook as $tag => $plugins) {
                foreach ($plugins as $name) {
                    $name         = 'Plugins\\' . $name . '\\' . $name . 'Plugin';
                    \Think\Hook::add($tag, $name);
                    $data[$tag][] = $name;
                }
            }
            S('plugin_list', $data);
        }
    }

}
