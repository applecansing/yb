<?php
namespace app\admin\controller;
use app\admin\model\Super;
use think\Controller;
use think\Request;
use think\Db;
class Login extends Controller{
    public function login(){
     	if(isset($_POST) && !empty($_POST))
     	{
     		$where['username'] = input('param.username','');
    		$where['password'] = md5(input('param.password',''));
     		$sql = Db::name('admin')->where($where)->find();
     		if(!empty($sql))
    		{
                session('admin',$sql);
    			return 'y';
     		}else{
     			return '用户名或密码错误';
     		}
        }else{
    
    	return $this->fetch();  
   }
    	
     }
   
    public function tc(){
        session(null);
        $this->redirect('login');
    }

  
}  // public function sss(){
    //      var_dump(session('admin'));
    // }
