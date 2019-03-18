<?php
namespace app\admin\controller;
use think\Db;
use think\Request;
class Ppp extends Conmmon{
   public function edit(){
      if(request()->isAjax()){ 
        $id = input('param.id');
        if(!empty($_FILES['uploadfile']['name'])){ 
          $map['img'] = $this->uploadC(request()->file('uploadfile'));
            }else{
          $map['img'] = input('param.img');
            }
          $res =  Db::name('ppp')->where('id ='.$id)->update($map);
          if($res){
             return 1;
                }else{ 
               return 0; 
           }
        
   }else{    
   $res = Db::name('ppp')->order('id desc')->find();
   $this->assign('data',$res);
    return $this->fetch();
   }

   }
 }