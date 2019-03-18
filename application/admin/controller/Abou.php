<?php
namespace app\admin\controller;
use think\Db;
use think\Request;
class Abou extends Conmmon{
   public function edit(){
      if(Request::instance()->isPost()){   
          $id = input('param.id');
          $map['ipone'] = input('param.ipone'); 
          $map['email'] = input('param.email'); 
          $map['ipone_c'] = input('param.ipone_c'); 
          $map['address'] = input('param.address');   
          $res =  Db::name('lian')->where('id ='.$id)->update($map);
          if($res){
             return 1;
                }else{ 
               return 0; 
          }
   }else{
        
        $res = Db::name('lian')->order('id desc')->find();
        $this->assign('data',$res);
        return $this->fetch();
   }

   }

 }