<?php
//控制器基类
class Action {
    protected $tpl;
    protected $model;
    public function __construct(&$tpl, &$model = NULL) {
        $this->tpl = $tpl;
        $this->model = $model;
    }
    protected function page($total) {
        $page = new Page($total, PAGE_SIZE);
        $this->model->limit = $page->limit;
        $this->tpl->assign('page',$page->ShowPage());
        $this->tpl->assign('num',($page->page-1)*PAGE_SIZE);
    }
}