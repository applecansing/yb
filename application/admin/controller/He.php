<?php
namespace app\admin\controller;
use think\Db;
use think\Request;
class He extends Conmmon{
public function index(){
   $list = Db::name('tuan')->order('xu desc')->select();
   $this->assign('data',$list);
   $this->assign('count',count($list));
   return $this->fetch();
  }
public function add(){
  if(request()->isAjax()){
    $map['zhiwei'] = input('param.zhiwei');
    $map['content'] = input('param.content');
    $map['name'] = input('param.name');
    $map['xu'] = input('param.xu');
    $map['status'] = input('param.status');
   if(!empty($_FILES['uploadfile']['name'])){ 
      $map['img'] = $this->uploadC(request()->file('uploadfile')); 
        }
     $sql = Db::name('tuan')->insert($map);
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
    $row = Db::name('tuan')->where('id='.$id)->delete();
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
   $map['zhiwei'] = input('param.zhiwei');
    $map['content'] = input('param.content');
    $map['name'] = input('param.name');
    $map['xu'] = input('param.xu');
   if(!empty($_FILES['uploadfile']['name'])){ 
          $map['img'] = $this->uploadC(request()->file('uploadfile'));
            }else{
          $map['img'] = input('param.img');
            }
  $res = Db::name('tuan')->where('id='.$id)->update($map);
    if($res){
   return 1;
  }else{
  return 0;
    }
 }else{
  $pid = input('param.pid');
  $sqlone = Db::name('tuan')->where('id='.$pid)->find();
  $this->assign('data',$sqlone);
  return $this->fetch();
 }
}



public function product_down(){
    if(request()->isAjax()){
        $ids = input('param.ids');
        $map['id'] = $ids;
        $map['status'] = 0;
        $res = Db::name('tuan')->update($map);
        if($res){
         return 1;
        }else{
        return 0;
        }
    }
  }

    public function product_downn(){
    if(request()->isAjax()){
        $ids = input('param.ids');
        $map['id'] = $ids;
        $map['statu'] = 0;
        $res = Db::name('tuan')->update($map);
        if($res){
         return 1;
        }else{
        return 0;
        }
    }
  }
public function product_upp(){
    if(request()->isAjax()){
        $ids = input('param.ids');
        $map['id'] = $ids;
        $map['statu'] = 1;
        $res = Db::name('tuan')->update($map);
        if($res){
         return 1;
        }else{
        return  0;
        }
    }
  }
   public function product_up(){
    if(request()->isAjax()){
        $ids = input('param.ids');
        $map['id'] = $ids;
        $map['status'] = 1;
        $res = Db::name('tuan')->update($map);
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
        $res = Db::name('tuan')->update($map);
        if($res){
         return 1;
        }else{
          return 0;
        }    
    }
  }

}