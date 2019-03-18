<?php
namespace app\admin\controller;
use think\Db;
use think\Request;
class Zhuan extends Conmmon{

//修改
   public function edit(){
      if(Request::instance()->isPost()){   
          $id = input('param.id');
          $map['content'] = input('param.content');   
          $res =  Db::name('sheng')->where('id ='.$id)->update($map);
          if($res){
             return 1;
                }else{ 
               return 0; 
          }
   }else{
        $pid = input('param.pid');
        $res = Db::name('sheng')->order('id desc')->find();
        $this->assign('data',$res);
        return $this->fetch();
   }

   }

 }