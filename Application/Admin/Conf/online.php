<?php

return array(
    /**
     * 下载URL路由控制
     */
    'URL_ROUTER_ON'       => true, //开启路由
    'URL_ROUTE_RULES'     => array(//定义路由规则
        'download/:id' => 'Admin/Index/download',
    //'download/:v' => 'Admin/Index/index',
    ),
    /**
     * 引入自定义标签库配置
     */
    //'APP_AUTOLOAD_PATH' => '@.TagLib', //标签库的文件名
    // 'TAGLIB_BUILD_IN' => 'Cx,Happy',
    /**
     * 缓存配置
     */
    'DATA_CACHE_TYPE'     => 'file',
    /**
     * RBAC权限控制配置
     */
    'USER_AUTH_ON'        => true,
    'USER_AUTH_TYPE'      => 2, // 默认认证类型 1 登录认证 2 实时认证
    'USER_AUTH_KEY'       => 'happy', // 用户认证SESSION标记
    'ADMIN_AUTH_KEY'      => 'administrator',
    // 'USER_AUTH_MODEL'   => 'SysUser', // 默认验证数据表模型
    'USER_AUTH_GATEWAY'   => 'Adminc/Public/login', // 默认认证网关
    'NOT_AUTH_CONTROLLER' => 'welcome', // 默认无需认证控制器
    'NOT_AUTH_ACTION'     => 'insert,update,upload', // 默认无需认证操作
    'RBAC_ROLE_TABLE'     => 'sys_role',
    'RBAC_USER_TABLE'     => 'sys_role_user',
    'RBAC_ACCESS_TABLE'   => 'sys_access',
    'RBAC_NODE_TABLE'     => 'sys_node',
    'TMPL_PARSE_STRING'   => array(
        '__PUBLIC__' => '/blog/Admin/Resource'
    ),
      /**
     * 资源目录前缀
     */
    'RESOURCE_PRE'  =>  '/blog/Admin',
);

