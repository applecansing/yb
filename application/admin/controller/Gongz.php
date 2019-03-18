<?php
namespace app\admin\controller;
use think\Db;
use think\Request;
class Gongz extends Conmmon{
   public function edit(){
      if(request()->isAjax()){ 
        $id = input('param.id');
        if(!empty($_FILES['uploadfile']['name'])){ 
          $map['img'] = $this->uploadC(request()->file('uploadfile'));
            }else{
          $map['img'] = input('param.img');
            }
          $res =  Db::name('gzewm')->where('id ='.$id)->update($map);
          if($res){
             return 1;
                }else{ 
               return 0; 
           }
        
   }else{    
   $res = Db::name('gzewm')->order('id desc')->find();
   $this->assign('data',$res);
    return $this->fetch();
   }

   }


 public function product_down(){
    if(request()->isAjax()){
        $ids = input('param.ids');
        $map['id'] = $ids;
        $map['status'] = 0;
        $res = Db::name('gzewm')->update($map);
        if($res){
         return 1;
        }else{
        return 0;
        }
    }
  }


  public function product_up(){
    if(request()->isAjax()){
        $ids = input('param.ids');
        $map['id'] = $ids;
        $map['status'] = 1;
        $res = Db::name('gzewm')->update($map);
        if($res){
         return 1;
        }else{
        return  0;
        }
    }
  }

  public function product_sort(){
    if(request()->isAjax()){
        $map = input('param.');
        $res = Db::name('gzewm')->update($map);
        if($res){
         return 1;
        }else{
          return 0;
        }    
    }
  }
}
