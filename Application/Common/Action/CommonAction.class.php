<?php

namespace Common\Action;

use Think\Action;
use \Common\Util\Rbac;

/**
 * Description of CommonAction
 *
 * @author Happy <yangbai6644@163.com>
 * @date 2013-12-18 23:07:16
 */
class CommonAction extends Action {

    public function _initialize() {
        /*
         *  注册InitHook插件
         *  \Think\Hook::add('InitHook', '\\Plugin\\InitHook');
         */
        if (!isset($_SESSION['user']['uid']) || session('user.uid') === '') {
            $this->redirect('/Public/login');
        }
        if (!\Think\RBAC::AccessDecision()) {
            throw_exception('没有权限！');
        }
        //p(\Think\RBAC::getAccessList(session(C('USER_AUTH_KEY'))));die();
    }

    /**
     * 权限验证方法
     * @return type
     */
    public function check_auth() {
        return Rbac::authenticate();
    }

    /**
     * 默认显示模版页面
     * @param type $model
     * @param type $template
     */
    public function index($model = null, $theme = null, $template = null) {
        /*
         *  监听InitHook插件
         *  $tag = 'sara';
         *  Think\Hook::listen('InitHook', $tag);
         */
        if (is_null($theme)) {
            $theme = isset($_GET[C('VAR_THEME')]) ? $_GET[C('VAR_THEME')] : C('DEFAULT_THEME');
        }
        /* 初始化模型 */
        \is_null($model) && $model = \D(CONTROLLER_NAME);
        /* 获取查询对象 */
        $map   = $this->_search($model);
        /* 子对象可以通过回掉函数改变查询映射对象，是按引用传递的，直接修改 */
        method_exists($this, '_filter') && $this->_filter($map);
        /* 根据指定条件生成列表 */
        $this->_list($model, $map, true);
        /* 分配菜单 */
        $this->showMenuList();
        /* 显示模版 */
        $this->theme($theme)->display($template);
    }

    private function _search($model) {
        
    }

    private function _list($model, $map = array(), $flag) {
        $order      = val('_order');
        //子类回调，进行必要的数据过滤
        method_exists($this, '_filterData') && $this->_filterData($map);
        method_exists($this, '_filter') && $this->_filter($map);
        $count      = $model->where($map)->count();
        $page       = new \Think\Page($count, 10);
        $limit      = $page->firstRow . ', ' . $page->listRows;
        $this->list = $model->where($map)->limit($limit)->order($order)->select();
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $this->page = $page->show();
    }

    /**
     * 获取菜单信息
     * @param type $menu_list
     */
    public function showMenuList($menu_list = '') {
        $this->menu_list = empty($menu_list) ? include APP_PATH . 'Admin/Conf/' . 'menu_list.php' : $menu_list;
    }

    public function add($template = null) {
        $this->display($template);
    }

    /**
     * 默认编辑操作
     * @param type $model
     */
    public function edit($model = null, $theme = null, $template = null) {
        \is_null($model) && $model = \D(CONTROLLER_NAME);
        $id    = isset($_REQUEST[$model->getPk()]) ? $_REQUEST[$model->getPk()] : $_REQUEST['id'];
        $data  = $model->getOneByPk($id);
        if (!empty($data)) {
            $this->vo = $data;
            $this->theme($theme)->display($template);
        } else {
            \throw_exception("对不起，您访问的数据不存在！");
        }
    }

    public function update($model = null) {
        is_null($model) && $model = D(CONTROLLER_NAME);
        if (!empty($model)) {
            if (false !== $model->create()) {
                if (false !== $model->save()) {
                    $this->success('编辑成功！', U('index'));
                } else {
                    $this->error('编辑失败！');
                }
            } else {
                $this->error($model->getError());
            }
        }
    }

    /**
     * 默认插入数据库操作
     * @param type $model
     */
    public function insert($model = null) {
        is_null($model) && $model = D(CONTROLLER_NAME);
        if (false !== $model->create()) {
            if (false !== $model->add()) {
                $this->success('添加成功！', U(MODULE_NAME . '/' . CONTROLLER_NAME . '/index'));
            } else {
                $this->error('添加失败！');
            }
        } else {
            $this->error($model->getError());
        }
    }

    /**
     * 默认删除标志操作
     * @param type $model
     */
    public function delete($model = null) {
        is_null($model) && $model = D(CONTROLLER_NAME);
        if (!empty($model)) {
            $pk  = $model->getPk();
            $ids = isset($_REQUEST[$pk]) ? $_REQUEST[$pk] : $_REQUEST['id'];
            if (isset($ids)) {
                if (false !== $model->where(array($pk => array('in', explode(',', $ids))))->setField('is_delete', 1)) {
                    $this->success('删除成功！');
                } else {
                    $this->error('删除失败！');
                }
            } else {
                $this->error('非法操作！');
            }
        }
    }

    /**
     * 默认物理删除操作
     * @param type $model
     */
    public function foreverdelete($model = null) {
        is_null($model) && $model = D(CONTROLLER_NAME);
        if (!empty($model)) {
            $data = isset($_REQUEST[$model->getPk()]) ? $_REQUEST[$model->getPk()] : $_REQUEST['id'];
            if (isset($data)) {
                $ids = explode(',', $data);
                if (false !== $model->where(array($model->getPk() => array('in', $ids)))->delete()) {
                    $this->success('删除成功！');
                } else {
                    $this->error('删除失败！');
                }
            } else {
                $this->error('非法操作！');
            }
        }
    }

    /**
     * 上传图片
     */
    public function uploadImg() {
        $this->upload(array('jpg', 'gif', 'png', 'jpeg'), 'logo');
    }

    /**
     * 文件上传
     * @param array $ext
     * @param type $path
     */
    public function upload(Array $ext, $path) {
        $upload           = new \Think\Upload();
        $upload->maxSize  = 3145728;
        $upload->savePath = '/' . $path . '/';
        $upload->exts     = $ext;
        $upload->autoSub  = true;
        $upload->subName  = array('date', 'Ymd');
        if (!($file             = $upload->upload())) {
            $this->error($upload->getError());
        } else {
            $image = new \Think\Image();
            $image->open(realpath('.') . '/Uploads' . $file['Filedata']['savepath'] . $file['Filedata']['savename']);
            $image->thumb(140, 100, 6)->save(realpath('.') . '/Uploads' . $file['Filedata']['savepath'] . 'th_' . $file['Filedata']['savename']);
            $this->ajaxReturn($file);
        }
    }

}
