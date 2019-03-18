<?php
namespace app\admin\controller;
use app\admin\model\Super;
use think\Controller;
use think\Request;
use think\Db;
class Index extends Conmmon{
 public function index(){
        return $this->fetch();
    }
 public function setpwd(){
    	
        if(isset($_POST) && !empty($_POST)){       
            $zh = session('admin');
            $ypass = md5(input('param.password',''));
            $xin = md5(input('param.pwd',''));
            $que = md5(input('param.repwd',''));
            if($zh['password'] == $ypass)
            {
            	if($xin == $que){
	            	$mima['password'] = md5(input('param.pwd'));
	            	$sql = Db::name('admin')->where("admin='".$zh['admin']."'")->update($mima);
	            	if($sql){
	            		$data['id'] = $zh['id'];
						$data['admin'] = $zh['admin'];
						$data['password'] = $xin;
						session("admin",$data);
	            		return 1;
	            	}else{
	            		return 2;
	            	}
            	}else{
            		return 2;
            	}
            }else{
            	return 2;
            }
                       
        }else{
            return $this->fetch();
        }
    }
 public function welcome(){
    	
        return $this->fetch();
    }

}