<?php
class Page {
    private $total;
    private $pagesize;
    private $limit;
    private $page;
    private $pagenum;
    private $url;
    private $bothnum;
    
    public function __construct($total, $pagesize) {
        $this->total = $total;
        $this->pagesize = $pagesize;
        $this->bothnum = 3;
        $this->pagenum = ceil($this->total / $this->pagesize);
        $this->page = $this->SetPage();
        $this->limit = "LIMIT ".($this->page-1) * $this->pagesize.",$this->pagesize";
        $this->url = $this->GetUrl();
    }
    //拦截器
    public function __get($key) {
        return $this->$key;
    }
    //分页信息
    public function ShowPage() {
        $page .= $this->Prev();
        $page .= $this->First();
        $page .= $this->PageList();
        $page .= $this->Last();
        $page .= $this->Next();
        return $page;
    }
    private function SetPage() {
        if (!empty($_GET['page'])) {
            if ($_GET['page'] > 0) {
                if ($_GET['page'] > $this->pagenum) {
                    return $this->pagenum;
                } else {
                    return $_GET['page'];
                }
                return $_GET['page'];
            } else {
                return 1;
            }
            return $_GET['page'];
        } else {
            return 1;
        }
    }
    private function PageList() {
        for ($i=$this->bothnum; $i>=1; $i--) {
            $page = $this->page - $i;
            if ($page < 1) continue;
            $pagelist .= "<a href='".$this->url."&page=".$page."'>【".$page."】</a>";
        }
        $pagelist .= "<span>【".$this->page."】</span>";
        for ($i=1; $i<=$this->bothnum; $i++) {
            $page = $this->page + $i;
            if ($page > $this->pagenum) break;
            $pagelist .= "<a href='".$this->url."&page=".$page."'>【".$page."】</a>";
        }
        return $pagelist;
    }
    //获取地址
    private function GetUrl() {
        $url = $_SERVER['REQUEST_URI'];
        $par = parse_url($url);
        if (isset($par['query'])) {
            parse_str($par['query'], $query);
            unset($query['page']);
            $url = $par['path'].'?'.http_build_query($query);
        }
        return $url;
    }
    //首页
    private function First() {
        if ($this->page > $this->bothnum + 1) {
            return "<a href='".$this->url."'>【1】</a>...";
        }  
    }
    //上一页
    private function Prev() {
        if ($this->page == 1) {
            return "<span>上一页</span>";
        }
        return "<a href='".$this->url."&page=".($this->page-1)."'>上一页</a>";
    }
    //下一页
    private function Next() {
        if ($this->page == $this->pagenum) {
            return "<span>下一页</span>";
        }
        return "<a href='".$this->url."&page=".($this->page+1)."'>下一页</a>";
    }
    //尾页
    private function Last() {
        if ($this->pagenum - $this->page > $this->bothnum) {
            return "...<a href='".$this->url."&page=".$this->pagenum."'>【".$this->pagenum."】</a>";
        }
    }
}