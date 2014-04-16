<?php

namespace Think\Template\TagLib;

use Think\Template\TagLib;

/**
 * Description of TagLibHappy
 *
 * @author Happy <yangbai6644@163.com>
 * @date 2013-12-24 21:59:15
 */
class Happy extends TagLib {

    protected $tags = array(
        // 标签定义： attr 属性列表 close 是否闭合（0 或者1 默认1） alias 标签别名 level 嵌套层次
        'list' => array('attr' => 'id,pk,style,action,actionlist,show,datasource,checkbox', 'close' => 0),
    );

    public function _list($tag) {
        $id = $tag['id'];
        $pk = $tag['pk'];
        $style = $tag['style'];
        $action = $tag['action'];
        $actionlist = $tag['actionlist'];
        $show = $tag['show'];
        $datasource = $tag['datasource'];
        $name = !empty($tag['name']) ? $tag['name'] : 'vo';
        $checkbox = empty($tag['checkbox']) ? 'key' : $tag['checkbox'];

        $htmlArr = "<table class='{$style}'>";
        /* 表头 */
        $htmlArr .= "<tr>";
        //是否显示checkbox
        $checkbox !== 'false' && $htmlArr .= "<td><input type='checkbox' id='" . $checkbox . "' onclick='EU.list.checkAll(\"" . $checkbox . "\");' /></td>";
        $show = explode(',', $show);
        $thId = array();
        foreach ($show as $key => $value) {
            $data = explode(":", $value);
            $thId[] = $data[0];
            $htmlArr .= "<th>$data[1]</th>";
        }
        /* 操作选项 */
        $action && $htmlArr .= "<th>操作</th>";
        /* 操作选项 */
        $htmlArr .= "</tr>";
        /* 表头 */
        /* 遍历数据 */
        $htmlArr .= "<volist name='" . $datasource . "' id='" . $name . "'>";
        $htmlArr .= "<tr align='center'>";
        //是否显示checkbox
        $checkbox !== 'false' && $htmlArr .= "<td width='2%'><input type='checkbox' name='" . $checkbox . "' value='{\$" . $name . '.' . $pk . "}' /></td>";
        foreach ($thId as $key => $value) {
            $htmlArr .= "<td>{\$" . $name . '.' . $value . "}</td>";
        }
        $action && $actionlist = explode(',', $actionlist);
        $htmlArr .= "<td>";
        foreach ($actionlist as $key => $value) {
            if (strpos($value, ':') !== FALSE) {
                $data = explode(':', $value);
                $htmlArr .= "<a href='javascript:void(0)' onclick='" . $data[0] . "(\"{\$" . $name . '.' . $pk . "}\");'>" . $data[1] . "</a>&nbsp;";
                continue;
            }
            if (count(explode('|', $value)) > 1) {
                $htmlArr .= "{\$" . $name . "." . $value . "}&nbsp;";
            } else {
                $htmlArr .= $value . "&nbsp;";
            }
        }
        $htmlArr .= "</td>";
        $htmlArr .= "</tr>";
        /* 遍历数据 */
        $htmlArr .= "</volist></table>";

        return $htmlArr;
    }

}
