<?php
class Parse {
	private $_tpl;
	public function __construct($_tplFile) {
		if (!$this->_tpl = file_get_contents($_tplFile)) {
			exit('模板文件出现错误');
		}
	}
    private function parVar() {
    	$pattern = '/\{\$([\w]+)\}/';
        if (preg_match($pattern, $this->_tpl)) {
            $this->_tpl = preg_replace($pattern, "<?php echo \$this->_vars['$1'];?>", $this->_tpl);
        }
    }
    function parIf() {
        $pattern = '/\{if\s+\$([\w]+)\}/';
        $patternEndIf = '/\{\/if\}/';
        $patternElse = '/\{else\}/';
        if (preg_match($pattern, $this->_tpl)) {
            if (preg_match($patternEndIf, $this->_tpl)) {
                $this->_tpl = preg_replace($pattern, "<?php if (\$this->_vars['$1']) {?>", $this->_tpl);
                $this->_tpl = preg_replace($patternEndIf, "<?php } ?>", $this->_tpl);
                if (preg_match($patternElse, $this->_tpl)) {
                    $this->_tpl = preg_replace($patternElse, "<?php } else { ?>", $this->_tpl);
                }
            } else {
                exit('if语句没有关闭');
            }
        }
    }
    private function parForeach() {
        $pattern = '/\{foreach\s+\$([\w]+)\(([\w]+), ([\w]+)\)\}/';
        $patternend = '/\{\/foreach\}/';
        $patternVar = '/\{\@([\w]+)([\w\-\>]*)\}/';
        if (preg_match($pattern, $this->_tpl)) {
            if (preg_match($patternend, $this->_tpl)) {
                $this->_tpl = preg_replace($pattern, "<?php foreach(\$this->_vars['$1'] as \$$2 => \$$3) { ?>", $this->_tpl);
                $this->_tpl = preg_replace($patternend, "<?php } ?>", $this->_tpl);
                if (preg_match($patternVar, $this->_tpl)) {
                    $this->_tpl = preg_replace($patternVar, "<?php echo \$$1$2;?>", $this->_tpl);
                }
            }
        }
    }
    private function parCommon() {
        $pattern = '/\{#\}(.*)\{#\}/';
        if (preg_match($pattern, $this->_tpl)) {
            $this->_tpl = preg_replace($pattern, "<?php /* $1 */ ?>", $this->_tpl);
        }
    }
    private function parInclude() {
        $pattern = '/\{include\s+file=(\"|\')([\w\.\-\/]+)(\"|\')\}/';
        if (preg_match_all($pattern, $this->_tpl, $_file)) {
            foreach ($_file[2] as $value) {
                if (!file_exists('templates/'.$value)) {
                    exit('包含文件出错');
                }
            $this->_tpl = preg_replace($pattern, "<?php \$tpl->create('$2');?>", $this->_tpl);
            }
        }
    }
    private function parConfig() {
        $pattern = '/<!--\{([\w]+)\}-->/';
        if (preg_match($pattern, $this->_tpl)) {
            $this->_tpl = preg_replace($pattern, "<?php echo \$this->_config['$1'];?>", $this->_tpl);
        }
    }
    public function compile($_parFile) {
        //解析模板内容
        $this->parVar();
        $this->parIf();
        $this->parCommon();
        $this->parForeach();
        $this->parInclude();
        $this->parConfig();
        //生成编译文件
        if (!file_put_contents($_parFile, $this->_tpl)) {
        	exit('生成编译文件错误');
        }
    }
}