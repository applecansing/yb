<?php
namespace app\admin\controller;
use think\Controller;
class Conmmon extends Controller{
	 public function _initialize(){
			if(!session('admin')){
				$this->redirect('admin/login/login');
			}
		}
	/**
	 *图片上传
	 *
	 * @param $file  string  图片名
	 * @return string  path  
	 */
    public function uploadC($file){
    	$info = $file->validate(['size'=>1024*1024*200,'ext'=>'jpg,png,gif,mp4'])->move(ROOT_PATH . DS . 'uploads');
	    if(!$info) {
	        // 上传错误提示错误信息
	        echo $file->getError(); exit;
	    }else{
	        // 上传成功 获取上传文件信息
	        return DS.'uploads'.DS.$info->getSaveName();
	    }
    }
    /**
     *多图片上传
     *
     * @param $file  string  图片名
     * @return string  path
     */
    public function uploadD($files){
        $res = '';
        foreach($files as $file){
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->validate(['size'=>1024*1024,'ext'=>'jpg,png,gif,mp4,avi'])->move(ROOT_PATH . DS . 'uploads');
            if($info){
                // 成功上传后 获取上传信息
                // 输出 jpg
                $res .=  DS.'uploads'.DS.$info->getSaveName().',';
            }else{
                // 上传失败获取错误信息
                echo $file->getError();
            }
        }
        $data = substr($res,0,strlen($res)-1);
        return $data;
    }
    //删绝对路径图片
    public function delUnlink($str){
        $urlData = explode(',',$str);
        foreach ($urlData as $v){
            $del = '.'.$v;
            @unlink($del);
        }
    }

}