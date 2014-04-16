<?php

/**
 * 前台项目公共函数库
 */

/**
 * 显示文章所述分类
 * @param  [type] $code [description]
 * @return [type]       [description]
 */
function getCategory($code) {
    $data = include APP_PATH . '/Home/Conf/menu.php';
    foreach ($data as $value) {
        if (isset($value['tags'])) {
            foreach ($value['tags'] as $val) {
                if ($val['tag_code'] == $code) {
                    return '<a href="'.U('/Home/' . $value['code']).'" title="查看' . $value['name'] .
                            '中的全部文章">' . $value['name'] . '</a>,
                    <a href="'.U('/Home/' . $value['code'].'/'.$val['tag_code']).'" title="查看' . $val['name'] .
                            '中的全部文章">' . $val['name'] . '</a>';
                }
            }
        }
    }
}

/**
 * 显示关键字
 * @param  [type] $value [description]
 * @return [type]        [description]
 */
function showKeywords($value) {
    $value = explode(',', $value);
    foreach ($value as $val) {
        $keywords .= '<a href="">' . $val . '</a>,';
    }
    return rtrim($keywords, ',');
}

/**
 * 根据子类tag_code获取上级code
 */
function getParentCode($tag_code) {
    $data = include APP_PATH . '/Home/Conf/menu.php';
    foreach ($data as $value) {
        if (isset($value['tags'])) {
            foreach ($value['tags'] as $val) {
                if ($tag_code == $val['tag_code']) {
                    return $value['code'];
                }
            }
        }
    }
    return '';
}

/**
 * 根据上级code获取下面所有的tag_code
 */
function getCTags($code) {
    $tags = array();
    $data = include APP_PATH . '/Home/Conf/menu.php';
    foreach ($data as $value) {
        if (isset($value['tags'])) {
            if ($value['code'] == $code) {
                foreach ($value['tags'] as $val) {
                    $tags[] = $val['tag_code'];
                }
            }
        }
    }
    return $tags;
}

/**
 * 显示导航分类下面文章总数
 */
function getArticleNumsByNav($value, $code) {
    if ($value == 'Sara')
        return '1988';
    static $_cacheValue = array();
    if (isset($_cacheValue[$value . $code])) {
        return $_cacheValue[$value . $code];
    } else {
        $tags                = getCTags($code);
        $_cacheValue[$value . $code] = (int) M($value)->where(array('code' => array('IN', $tags)))->count();
        return $_cacheValue[$value . $code];
    }
}

/**
 * 显示标签下面的文章总数
 */
function getArticleNumsByTag($model_name, $tag_code) {
    static $_cacheValue = array();
    if ($tag_code == 'index') {
        if (isset($_cacheValue[CONTROLLER_NAME])) {
            return $_cacheValue[CONTROLLER_NAME];
        } else {
            $tags                         = getCTags(CONTROLLER_NAME);
            $_cacheValue[CONTROLLER_NAME] = M($model_name)->where(array('code' => array('IN', $tags)))->count();
            return $_cacheValue[CONTROLLER_NAME];
        }
    }
    if (isset($_cacheValue[$tag_code])) {
        return $_cacheValue[$tag_code];
    } else {
        $_cacheValue[$tag_code] = M($model_name)->where(array('code' => $tag_code))->count();
        return $_cacheValue[$tag_code];
    }
}

/**
 * 显示当前时间
 */
function showNowTime() {
    $note      = '';
    $week_name = '';
    $hour      = (int) date('H', time());
    $week      = (int) date('w', time());
    switch ($week) {
        case '0':
            $week_name = '天';
            break;
        case '1':
            $week_name = '一';
            break;
        case '2':
            $week_name = '二';
            break;
        case '3':
            $week_name = '三';
            break;
        case '4':
            $week_name = '四';
            break;
        case '5':
            $week_name = '五';
            break;
        case '6':
            $week_name = '六';
            break;
    }

    switch (true) {
        case $hour < 6:
            $note = '凌晨好！';
            break;
        case $hour < 10:
            $note = '早上好！';
            break;
        case $hour < 13:
            $note = '中午好！';
            break;
        case $hour < 18:
            $note = '下午好！';
            break;
        case $hour < 24:
            $note = '晚上好！';
            break;
    }
    return $note . '&nbsp;' . toDate(time(), 'Y年m月d日') . ' 星期' . $week_name;
}

/**
 * 从多说获取文章对应的评论数
 */
function getCommentsFromDuoshuo($value) {
    $data      = file_get_contents('http://api.duoshuo.com/threads/counts.json?short_name=yangbai&threads=' . $value);
    $returnArr = json_decode($data, true);
    return $returnArr['response'][$value]['comments'] ? : '0';
}

/**
 * 判断文章的日期是否在一天之内，
 * 是的话加上最新标记
 * @param type $time
 * @return boolean
 */
function is_newest($time) {
    if ((time() - $time) < 3600 * 24) {
        return true;
    }
    return false;
}

/**
 * 显示代码高亮
 * @param type $value
 * @return type
 */
function displayCode($value) {
    return str_replace(array('[code]', '[/code]'), array('<code class="prettyprint linenums lang-php">', '</code>'), $value);
}

/**
 * 显示用户的名称
 * @param type $value
 * @return type
 */
function displayUserName($value) {
   return getFieldNameByFieldValue('SysUser', 'full_name', 'user_id', $value);
}

/**
 * 简单缓存字段
 * @staticvar array $_cacheValue
 * @param type $table
 * @param type $oField
 * @param type $sField
 * @param type $sFieldValue
 * @return array
 */
function getFieldNameByFieldValue($table, $oField, $sField, $sFieldValue) {
    static $_cacheValue = array();
    if (isset($_cacheValue[$sField . $sFieldValue])) {
        return $_cacheValue[$sField . $sFieldValue];
    } else {
        return $_cacheValue[$sField . $sFieldValue] = M($table)->where(array($sField => $sFieldValue))->getField($oField);
    }
}
