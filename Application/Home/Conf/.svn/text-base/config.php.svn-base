<?php

return array(
    //开启路由
    'URL_ROUTER_ON'        => true,
    'URL_ROUTE_RULES'      => array(
        //'/^TechnologyShare\/(php|mysql|linux|javascript)$/'	=> './TechnologyShare/index?tag=:1',
        /* 菜单分类标签路由 */
        'TechnologyShare/:tag' => './TechnologyShare/index',
        'Free/:tag'            => './Free/index',
        'Life/:tag'            => './Life/index',
        'Job/:tag'             => './Job/index',
        /* 菜单分类标签路由 */

        /* 博文内容页路由 */
        //'/^blog_(\d+)$/'		=>	'./Content/index?id=:1',
        '/^([a-zA-Z]*)\/(\d+)$/' => './Content/index?tag=:1&id=:2',
        //首页分页路由
        '/^(\d+)$/'    =>  './Index/index?p=:1',
    ),
    'TMPL_TEMPLATE_SUFFIX' => '.html',
        //'DEFAULT_THEME' => 'xm',
);
