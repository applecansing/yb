<?php
namespace app\admin\controller;
use think\Db;
use think\Request;
class Wen extends Conmmon{
 public function index(){
   $list = Db::name('wenzhang')->order('xu desc')->select();
   $this->assign('data',$list);
   $this->assign('count',count($list));
 return $this->fetch();
  }
public function add(){
  if(request()->isAjax()){
    $map['title'] = input('param.title');
    $map['time'] = input('param.time');
    $map['content'] = input('param.content');
    $map['zhaiyao'] = input('param.zhaiyao');
    $map['xu'] = input('param.xu');
    $map['status'] = input('param.status');
    $map['k_title'] = input('param.k_title');
    $map['k_key'] = input('param.k_key');
    $map['k_cop'] = input('param.k_cop');
     $sql = Db::name('wenzhang')->insert($map);
     if($sql){
      return 1;
     }else{
      return 0;
     }

  }else{
  $sq = Db::name('title')->order('id desc')->find();
  $this->assign('sq',$sq);
 return $this->fetch();
  }
 } 
 public  function del(){
  if(request()->isAjax()){
    $id = input('param.id');
    $row = Db::name('wenzhang')->where('id='.$id)->delete();
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
     $map['title'] = input('param.title');
    $map['time'] = input('param.time');
    $map['content'] = input('param.content');
    $map['zhaiyao'] = input('param.zhaiyao');
    $map['xu'] = input('param.xu');
    $map['status'] = input('param.status');
    $map['k_title'] = input('param.k_title');
    $map['k_key'] = input('param.k_key');
    $map['k_cop'] = input('param.k_cop');
    $res = Db::name('wenzhang')->where('id='.$id)->update($map);
    if($res){
   return 1;
  }else{
  return 0;
    }
 }else{
  $pid = input('param.pid');
  $sqlone = Db::name('wenzhang')->where('id='.$pid)->find();
  $this->assign('data',$sqlone);
  return $this->fetch();
 }
}

public function product_downn(){
    if(request()->isAjax()){
        $ids = input('param.ids');
        $map['id'] = $ids;
        $map['statu'] = 0;
        $res = Db::name('wenzhang')->update($map);
        if($res){
         return 1;
        }else{
        return 0;
        }
    }
  }
  public function product_down(){
    if(request()->isAjax()){
        $ids = input('param.ids');
        $map['id'] = $ids;
        $map['status'] = 0;
        $res = Db::name('wenzhang')->update($map);
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
        $res = Db::name('wenzhang')->update($map);
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
        $res = Db::name('wenzhang')->update($map);
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
        $res = Db::name('wenzhang')->update($map);
        if($res){
         return 1;
        }else{
          return 0;
        }    
    }
  }
}