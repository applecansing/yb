<?php
namespace app\admin\controller;
use think\Db;
use think\Request;
class Qq extends Conmmon{
//修改
   public function edit(){
      if(Request::instance()->isPost()){   
          $id = input('param.id');
          $map['qq'] = input('param.qq'); 
           
          $res =  Db::name('qq')->where('id ='.$id)->update($map);
          if($res){
             return 1;
                }else{ 
               return 0; 
          }
   }else{
        $pid = input('param.pid');
        $res = Db::name('qq')->order('id desc')->find();
            $this->assign('data',$res);
            return $this->fetch();
   }

   }

 }