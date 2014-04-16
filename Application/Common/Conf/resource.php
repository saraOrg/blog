<?php

empty($style_name) && $style_name = 'style';
$ver        = time();
return array(
    'basic'     => array(
        'js'  => array(
            // '/Resource/Js/jquery-1.7.2.min.js?' . $ver,
            '/Resource/Js/core.min.js?' . $ver,
            '/Resource/Js/common.js?' . $ver,
        //'/Public/bootstrap/js/bootstrap.min.js?' . $ver,
        ),
        'css' => array(
        //'/Public/bootstrap/css/bootstrap.min.css?' . $ver,
        //'/Public/bootstrap/css/bootstrap-responsive.min.css?' . $ver,
        // '/Public/Js/skins/' . $style_name . '.css?' . $ver,
        //'/Public/Css/style/' . $style_name . '.css?' . $ver,
        //'/Public/Css/basic.css',
        ),
    ),
    'thinkbox'  => array(
        'js'  => array(
            '/Resource/ThinkBox/js/thinkbox.min.js?' . $ver,
        ),
        'css' => array(
            '/Resource/ThinkBox/css/style.css?' . $ver
        ),
    ),
    'uploadify' => array(
        'js'  => array(
            '/Resource/uploadify/jquery.uploadify.min.js?' . $ver,
        ),
        'css' => array(
            '/Resource/uploadify/uploadify.css?' . $ver,
        ),
    ),
    'ztree'     => array(
        'js'  => array(
            '/Resource/zTree/js/jquery.ztree.core-3.5.min.js?' . $ver,
            '/Resource/zTree/js/jquery.ztree.excheck-3.5.min.js?' . $ver,
            '/Resource/zTree/js/jquery.ztree.exedit-3.5.js?' . $ver,
        ),
        'css' => array(
            '/Resource/zTree/css/zTreeStyle/zTreeStyle.css?' . $ver,
        ),
    ),
    'editor'    => array(
        'js' => array(
            '/Resource/editor/kindeditor-min.js?' . $ver,
            '/Resource/editor/lang/zh_CN.js?' . $ver,
        ),
    ),
    //myDate97日期选择插件
    'mydate'    => array(
        'js' => array(
            '/Resource/mydate/WdatePicker.js?' . $ver,
        ),
    ),
    'tp'        => array(
        'js'  => array(
            '/Resource/tp/js/ValidForm.js?' . $ver,
            '/Resource/tp/js/prettify.js?' . $ver,
        ),
        'css' => array(
            '/Resource/tp/css/base.css?' . $ver,
            '/Resource/tp/css/header.css?' . $ver,
            '/Resource/tp/css/img.css?' . $ver,
            '/Resource/tp/css/module.css?' . $ver,
            '/Resource/tp/css/prettify.css?' . $ver,
            '/Resource/tp/css/style.css?' . $ver,
        ),
    ),
    'default'   => array(
        'js'  => array(
            '/Resource/default/js/common.js?' . $ver,
        ),
        'css' => array(
            '/Resource/default/css/style.css?' . $ver,
            '/Resource/default/css/common.css?' . $ver,
            '/Resource/default/css/main.css?' . $ver,
             '/Resource/default/css/plugins.css?' . $ver,
        )
    ),
    'hd'        => array(
        'js'  => array(
            '/Resource/hd/Js/index.js?' . $ver,
            '/Resource/hd/Js/common.js?' . $ver,
        ),
        'css' => array(
            '/Resource/hd/Css/common.css?' . $ver,
            '/Resource/hd/Css/index.css?' . $ver,
        )
    ),
    'wbdialog'  => array(
        'js'  => array(
            '/Resource/wbdialog/W.dialog.js?' . $ver
        ),
        'css' => array(
            '/Resource/wbdialog/css/dialog.css?' . $ver,
            '/Resource/wbdialog/css/dialog_extra.css?' . $ver
        )
    ),
    'validate'  => array(
        'js' => array(
            '/Resource/Js/validate.js?' . $ver
        )
    )
);
