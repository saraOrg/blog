<?php

/**
 * =================================================
 * 项目公共基础函数库文件
 * =================================================
 * 用于定义项目常用的基础函数
 * ================================================
 * @category Happy
 * @package Happy
 * @subpackage Happy/Common
 * @author Happy <yangbai6644@163.com>
 * @dateTime 2013-12-20 19:08:43
 * ================================================
 */

        const BLOG_VERSION = '19880430';
        const BLOG_PROCESS = '30%';

/**
 * 默认打印函数
 * @param type $arr
 */
function p($arr) {
    echo "<pre>", print_r($arr, true), "</pre>";
}

/**
 * 检验验证码
 * @param type $code
 * @param type $id
 * @return type
 */
function check_verify($code) {
    $verify = new \Think\Verify();
    return $verify->check($code, 1988);
}

/**
 * 加载资源
 * @param type $name
 * @param type $title
 * @param type $charser
 * @return type
 */
function resource($name, $title, $charset = 'UTF-8') {
    $headArr    = array();
    $pre        = C('RESOURCE_PRE');
    //定義全局的js變量
    array_push($headArr, '<script>'
            . 'var URL="' . $pre . '/index.php/' . CONTROLLER_NAME . '";'
            . 'var APP="' . __APP__ . '";var PUBLIC="' . $pre . '/Resource/' . '";'
            . 'var CUR="' . CONTROLLER_NAME . '";'
            . 'var LANG="' . (isset($_GET[C('VAR_LANGUAGE')]) ? $_GET[C('VAR_LANGUAGE')] : 'cn') . '";'
            . '</script>');
    array_push($headArr, '<meta http-equiv="Content-Type" content="text/html;charset="' . $charset . '">');
    array_push($headArr, '<meta name="keywords" content="爱情花园,怎么唱情歌，惜@君"/>');
    array_push($headArr, '<meta name="description" content="如果可以的话，我的肩膀可以借你无限期使用，虽然它不是那么的宽厚，但足够你好好休息一下了！"/>');
    $style_name = session('sys_style_name') ? session('sys_style_name') : 'style';
    $resource   = include(COMMON_PATH . '/Conf/' . 'resource.php');
    $arr        = array();
    $arr        = explode(',', $name);
//    if (!in_array('basic', $arr)) {
//        return implode("\n", $headArr);
//    }
    foreach ($resource as $key => $value) {
        # code...
        if (in_array($key, $arr)) {
            foreach ($value['js'] as $k => $val) {
                # code...
                array_push($headArr, '<script type="text/javascript" src="' . $pre . $val . '"></script>');
            }
            foreach ($value['css'] as $k => $val) {
                # code...
                array_push($headArr, '<link rel="stylesheet" type="text/css" href="' . $pre . $val . '" />');
            }
        }
    }
    array_push($headArr, "<title>$title</title>");
    return implode("\n", $headArr);
}

/**
 * 默认格式时间戳函数
 * @param type $time
 * @param type $format
 * @return type
 */
function toDate($time = null, $format = 'Y-m-d H:i:s') {
    is_null($time) && $time = time();
    return date($format, $time);
}

function time_format($time) {
    empty($time) && $time  = time();
    //获取当前零时零分零秒的时间
    //用于判断时间是否超过今天
    $today = strtotime(date('Y-m-d', time()));
    $diff  = $time - $z_time;
    $diff  = time() - $time;
    switch (true) {
        case $diff < 10:
            return '刚刚';
        case $diff < 60:
            return (time() - $time) . ' 秒前';
        case $diff >= 60 && $diff < 60 * 60:
            return floor((time() - $time) / 60) . ' 分钟前';
        case $diff >= 60 * 60 && $diff < 60 * 60 * 8:
            return floor((time() - $time) / 60 / 60) . ' 小时前';
        case $time > $today:
            return '今天 ' . date('H:i', $time);
        default:
            return toDate($time);
    }
}

/**
 * 默认全局变量过滤
 * @param type $value
 */
function default_input_filter(&$value) {
    $value = htmlspecialchars($value);
}

/**
 * 快速service函数
 * @param type $model 模型名称
 * @param type $method 方法名称
 * @param type $layer 层名称
 * @return type
 */
function service($model = MODULE_NAME, $method = ACTION_NAME, $layer = 'Service') {
    return D($model, $layer)->$method();
}

/**
 * 快捷缓存方法，增加保存缓存列表的key方便后续清理缓存
 * @param type $name
 * @param type $value
 * @param type $options
 * @param type $cache_key
 * @return type
 */
function ES($name, $value = '', $options = null, $cache_key = '_cache_keys') {
    //缓存初始化,tp3.2.0不初始化会报错！
    S(array('type' => 'file'));
    if (!empty($value)) {
        S($cache_key) ? S($cache_key, array_unique(array_merge(S($cache_key), array($name)))) : S($cache_key, array($name, $cache_key));
    }
    return S($name, $value, $options);
}

/**
 * 静态缓存字段，支持跨模块
 * @staticvar array $_cacheValue
 * @param type $key
 * @param type $value
 * @return type
 */
function val($key, $value = null) {
    static $_cacheValue = array();
    if (!is_null($value)) {
        return $_cacheValue[$key] = $value;
    }
    return isset($_cacheValue[$key]) ? $_cacheValue[$key] : null;
}

/**
 * 静态缓存方式根据表的一个字段值获取另外一个字段值
 * @staticvar array $_cacheValue
 * @param type $dField
 * @param type $sField
 * @param type $sFieldValue
 * @param type $tableName
 * @param type $where
 * @return type
 */
function getFieldByTable($dField, $sField, $sFieldValue, $tableName = '', $where = array()) {
    static $_cacheValue = array();
    if (empty($_cacheValue)) {
        $data = M($tableName)->where($where)->where(array($sField => $sFieldValue))->select();
        foreach ($data as $value) {
            $_cacheValue = $value;
        }
    }
    return isset($_cacheValue[$dField]) ? $_cacheValue[$dField] : '';
}

function getSequence($table, $field, $minValue = 1000, $maxValue = 9999, $code = '', $desc = '') {
    //static $_cacheValue = array();
    $data       = array(
        'table_name'  => $table,
        'field_name'  => $field,
        'min_value'   => $minValue,
        'max_value'   => $maxValue,
        'next_value'  => $minValue,
        'seq_code'    => $code,
        'seq_desc'    => $desc,
        'create_date' => toDate(),
    );
    $table_name = M('SysSequence')->where(array('table' => $table))->getField('table_name');
    if (empty($table_name)) {
        M('SysSequence')->add($data);
    }
    //获取最大序列号
    $maxId = M('SysSequence')->where(array('table' => $table))->getField('next_value');
    //更新序列号的值
    M('SysSequence')->where(array('table' => $table))->setInc('next_value');
    return $maxId;
}

/**
 * 处理插件钩子
 * @param string $hook   钩子名称
 * @param mixed $params 传入参数
 * @return void
 */
function hook($hook, $params = array()) {
    \Think\Hook::listen($hook, $params);
}
