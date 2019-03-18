<?php
namespace app\admin\controller;
use think\Db;
use think\Request;
class Contact extends Conmmon{
public function index(){
   $list = Db::name('contact')->order('xu desc')->select();
   $this->assign('data',$list);
   $this->assign('count',count($list));
   return $this->fetch();
  }

public function add(){
  if(request()->isAjax()){
    $map = input('param.');
     $sql = Db::name('contact')->insert($map);
     if($sql){
     	return 1;
     }else{
     	return 0;
     }
  }else{
 return $this->fetch();
  }
} 

public  function del(){
  if(request()->isAjax()){
    $id = input('param.id');
    $row = Db::name('contact')->where('id='.$id)->delete();
    if($row){
    	return 1;
    }else{
    	return 0;
    }
  }
}

public function edit(){
 if(request()->isAjax()){
 	  $id = input('param.id');
    $map = input('param.');
    $res = Db::name('contact')->where('id='.$id)->update($map);
     return 1;
  }else{
  $id = input('param.id');
  $sqlone = Db::name('contact')->find();
  $this->assign('data',$sqlone);
  return $this->fetch();
 }
}
public function product_down(){
    if(request()->isAjax()){
        $ids = input('param.ids');
        $map['id'] = $ids;
        $map['status'] = 0;
        $res = Db::name('contact')->update($map);
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
        $res = Db::name('contact')->update($map);
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
        $res = Db::name('contact')->update($map);
        if($res){
         return 1;
        }else{
          return 0;
        }    
    }
  }

}