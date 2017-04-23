<?php
/**
* 文件上传类
*/
class Upload {
	private $files = array();
	private $filename;
	private $filesrc;
	private $mes;
	private $filepath;
	private $maxsize = 204800;
	private $allowExt = array('jpeg','jpg','gif','png');
	private $ext;
	private $today;
	private $linktody;
    
	public function __construct() {
	    $this->today = date('Ymd');
	    $this->filepath = UPLOAD.$this->today.'/';
	    $this->UploadFile();
	}
	private function UploadFile() {
	    foreach ($this->getFiles() as $value) {
    	    if ($value['error'] === UPLOAD_ERR_OK) {
    	        $this->filesize($value);
    	        $this->ispost($value);
    	        $this->filetype($value);
    	        $this->makedir($value);
    	        $this->flag($value);
    	        $this->filename = $this->filepath.''.$this->getUniqname().'.'.$this->getext($value);
    	        if (!move_uploaded_file($value['tmp_name'], $this->filename)) {
    	            Tool::alertBack('上传失败');
    	        } else {
//     	            print_r($value);
//     	            echo $this->filepath;
//     	            $this->filesrc = explode(',', $this->filesrc);
//         	        $this->filesrc .= $this->filename.',';
//         	        echo $this->filename;
    	            Tool::alertOpenClose('上传成功！', $this->filename);
    	        }
    	    } else {
    	        $this->checkerror($value);
    	    }
	    }
    }
	public function getpath() {
	    return $this->filename;
	}
	// 得到文件上传的信息
	private function getFiles(){
	    $i=0;
	    foreach($_FILES as $file){
	        if (is_string($file['name'])) {
	            $this->files[$i]=$file;
	            $i++;
	        } elseif (is_array($file['name'])) {
	            foreach($file['name'] as $key=>$val){
	                $this->files[$i]['name']=$file['name'][$key];
	                $this->files[$i]['type']=$file['type'][$key];
	                $this->files[$i]['tmp_name']=$file['tmp_name'][$key];
	                $this->files[$i]['error']=$file['error'][$key];
	                $this->files[$i]['size']=$file['size'][$key];
	                $i++;
	            }
	        }
	    }
	    return $this->files;
	}
	// 判断错误号
	private function checkerror($file) {
		switch ($file['error']) {
			case 1 :
				$this->mes = '上传文件超过了PHP配置文件中upload_max_filesize选项的值';
				break;
			case 2 :
				$this->mes = '超过了表单MAX_FILE_SIZE限制的大小';
				break;
			case 3 :
				$this->mes = '文件部分被上传';
				break;
			case 4 :
				$this->mes = '没有选择上传文件';
				break;
			case 6 :
				$this->mes = '没有找到临时目录';
				break;
			case 7 :
			case 8 :
				$this->mes = '系统错误';
				break;
		}
	    Tool::alertBack($this->mes);
	}
	// 获取文件扩展名
	private function getext($file) {
		$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
		return $ext;
	}
	// 检测上传文件的类型
	private function filetype($file) {
		if (!in_array(strtolower($this->getext($file)), $this->allowExt)) {
			Tool::alertBack('不合法的文件类型');
		}
	}
	// 检测上传文件大小是否符合规范
	private function filesize($file) {
		if ($file['size'] > $this->maxsize) {
			Tool::alertBack('文件过大');
		}
	}
	// 检测图片是否为真实的图片类型
	private function flag($file) {
		if(!getimagesize($file['tmp_name'])){
			Tool::alertBack('不是真实的图片类型');
		}
	}
	// 检测文件是否是通过HTTP POST方式上传上来
	private function ispost($file) {
		if (!is_uploaded_file($file['tmp_name'] )) {
			Tool::alertBack('不是通过httppost方式上传的');
		}
	}
	// 创建文件夹
	private function makedir() {
		if (!file_exists($this->filepath) || !is_writable($this->filepath)) {
			mkdir ( $this->filepath, 0777, true );
			chmod ( $this->filepath, 0777 );
		}
	}
	// 产生唯一字符串
	private function getUniqname() {
		return md5(uniqid(microtime(true),true));
	}
}