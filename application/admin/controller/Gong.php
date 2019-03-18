<?php
namespace app\admin\controller;
use think\Db;
use think\Request;
class Gong extends Conmmon{

//修改
   public function edit(){
      if(Request::instance()->isPost()){   
          $id = input('param.id');
          $map['content'] = input('param.content');   
          $res =  Db::name('gongcheng')->where('id ='.$id)->update($map);
          if($res){
             return 1;
                }else{ 
               return 0; 
          }
   }else{
        $pid = input('param.pid');
        $res = Db::name('gongcheng')->order('id desc')->find();
        $this->assign('data',$res);
        return $this->fetch();
   }

   }

 }