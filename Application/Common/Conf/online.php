<?php

$module = isset($_GET['m']) ? $_GET['m'] : 'Home';

return array(
    /**
     * 初始化配置
     */
    'DEFAULT_C_LAYER'   => 'Action', //控制器后缀名，默认是Controller
    'MODULE_ALLOW_LIST' => array('Home', 'Admin', 'Mobile'),
    'DEFAULT_MODULE'    => $module, //默认模块
    'MODULE_DENY_LIST'  => array('Common', 'User'), //默认禁用模块
    'COLOR_STYLE'       => 'blue_color', //登录界面的颜色方案
    'VAR_FILTERS'       => 'default_input_filter', //默认参数过滤方法
    'SHOW_PAGE_TRACE'   => FALSE,
    'TMPL_PARSE_STRING' => array(
        '__PUBLIC__' => '/blog/Public', // 更改默认的__PUBLIC__ 替换规则
    ),
    /**
     * 数据库配置项
     */
    'DB_TYPE'           => 'mysqli', // 数据库类型,tp2.0必须配置否则数据库无法连接
    'DB_HOST'           => 'localhost', // 服务器地址
    'DB_NAME'           => 'happy', // 数据库名
    'DB_USER'           => 'root', // 用户名
    'DB_PWD'            => '358975', // 密码
    'DB_PORT'           => '3306', // 端口
    'DB_PREFIX'         => '', // 数据库表前缀
    /**
     * 用户登录相关配置项
     */
    'LOGIN_ERROR_COUNT' => 5, //登录错误最大次数
    'USER_LOCK_TIME'    => 60, //用户锁定时间
    /**
     * 多语言切换配置
     */
    'LANG_SWITCH_ON'    => true, // 开启语言包功能
    'LANG_AUTO_DETECT'  => true, // 自动侦测语言 开启多语言功能后有效
    'LANG_LIST'         => 'zh-cn,zh-tw,en-us', // 允许切换的语言列表 用逗号分隔
    'DEFAULT_THEME'     => 'cn', // 默认模版主题名称 
    'DEFAULT_LANGUAGE'  => 'cn', // 默認系統語言
    'VAR_LANGUAGE'      => 'l', // 默认语言切换变量
    'VAR_THEME'         => 't', // 默认模版切换变量
    'URL_MODEL'         => 1,
    //自动命名空间加载
     'AUTOLOAD_NAMESPACE'    =>  array('Plugins' => '../Plugins/'),
     //插件列表
    'PLUGIN_LIST'   =>  array(
        'AdminIndex'    =>  array(
            'SiteStat',
            'SystemInfo'
        ),
    ),
);
