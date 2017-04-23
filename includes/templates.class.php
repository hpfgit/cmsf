<?php
class Templates{
    //通过一个字段来接受变量 数组
    private $_vars = array();
    private $_config = array();
    public function __construct(){
        if (!is_dir(TPL_DIR) || !is_dir(TPL_C_DIR) || !is_dir(CACHE)){
            exit('ERROR:文件不存在');
        }
        $array = include CONFIG.'profile.php';
        foreach ($array as $key=>$value) {
            $this->_config[$key] = $value;
        }
    }
    public function assign($_var, $_value) {
        if (isset($_var) && !empty($_var)) {
            $this->_vars[$_var] = $_value;
        } else {
            exit('必须设置模板变量');
        }
    }
    //cache()方法不执行php代码
    public function cache($_file) {
        //给include进来的tpl传一个模板操作的对象
        $tpl = $this;
        $_tplFile = TPL_DIR.$_file;
        if (!file_exists($_tplFile)){
            exit('模板文件不存在');
        }
        //是否加入参数
        if (!empty($_SERVER['QUERY_STRING'])) {
            $_file .= $_SERVER['QUERY_STRING'];
        }
        $_parfile = TPL_C_DIR.md5($_file).$_file.'.php';
        $_cachefile = CACHE.md5($_file).$_file.'.html';
        //第二次执行相同的文件时直接载入缓存文件
        if (IS_CACHE) {
            //缓存文件和编译文件都要存在
            if (file_exists($_cachefile) && file_exists($_parfile)) {
                //判断模板文件是否修改过
                if (filemtime($_parfile) > filemtime($_tplFile) && filemtime($_cachefile) >= filemtime($_parfile)) {
                    require $_cachefile;
                    exit();
                }
            }
        }
        //编译文件存在 或者 模板文件修改过 生成编译文件
        if (!file_exists($_parfile) || filemtime($_parfile) < filemtime($_tplFile)){
            // file_put_contents($_parfile, file_get_contents($_tplFile));
            require_once ROOT_PATH.'/includes/parse.class.php';
            $parse = new Parse($_tplFile);
            $parse->compile($_parfile);
        }
        // 载入编译文件
        require $_parfile;
        // 缓存文件
        if (IS_CACHE) {
            file_put_contents($_cachefile, ob_get_contents());
            ob_clean();
            require $_cachefile;
        }
    }
    public function display($_file){
        //给include进来的tpl传一个模板操作的对象
        $tpl = $this;
        $_tplFile = TPL_DIR.$_file;
        if (!file_exists($_tplFile)){
            exit('模板文件不存在');
        }
        //是否加入参数
        if (!empty($_SERVER['QUERY_STRING'])) {
            $_file .= $_SERVER['QUERY_STRING'];
        }
        $_parfile = TPL_C_DIR.md5($_file).$_file.'.php';
        $_cachefile = CACHE.md5($_file).$_file.'.html';
        
        //编译文件存在 或者 模板文件修改过 生成编译文件
        if (!file_exists($_parfile) || filemtime($_parfile) < filemtime($_tplFile)){
            // file_put_contents($_parfile, file_get_contents($_tplFile));
            require_once ROOT_PATH.'/includes/parse.class.php';
            $parse = new Parse($_tplFile);
            $parse->compile($_parfile);
        }
        // 载入编译文件
        require $_parfile;
        // 缓存文件
        if (IS_CACHE) {
            file_put_contents($_cachefile, ob_get_contents());
            ob_clean();
            require $_cachefile;
        }
    }
    public function create($_file) {
        $_tplFile = TPL_DIR.$_file;
        if (!file_exists($_tplFile)){
            exit('模板文件不存在');
        }
        $_parfile = TPL_C_DIR.md5($_file).$_file.'.php';
        //编译文件存在 或者 模板文件修改过 生成编译文件
        if (!file_exists($_parfile) || filemtime($_parfile) < filemtime($_tplFile)){
            // file_put_contents($_parfile, file_get_contents($_tplFile));
            require_once ROOT_PATH.'/includes/parse.class.php';
            $parse = new Parse($_tplFile); //模板文件
            $parse->compile($_parfile); //编译文件
        }
        //载入编译文件
        require $_parfile;
    }
}