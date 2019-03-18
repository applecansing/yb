<?php
namespace app\admin\controller;
use think\Db;
use think\Request;
class Kan extends Conmmon{
 public function index(){
   $list = Db::name('zhoukan')->order('xu desc')->select();
   $this->assign('data',$list);
   $this->assign('count',count($list));
 return $this->fetch();
  }
public function add(){
  if(request()->isAjax()){
     if(!empty($_FILES['uploadfile']['name'])){ 
      $map['img'] = $this->uploadC(request()->file('uploadfile')); 
           }
    $map['title'] = input('param.title');
    $map['content'] = input('param.content');
    $map['zhaiyao'] = input('param.zhaiyao');
    $map['qishu'] = input('param.qishu');
    $map['xu'] = input('param.xu');
    $map['status'] = input('param.status');
    $map['k_title'] = input('param.k_title');
    $map['k_key'] = input('param.k_key');
    $map['k_cop'] = input('param.k_cop');
     $sql = Db::name('zhoukan')->insert($map);
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
    $row = Db::name('zhoukan')->where('id='.$id)->delete();
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
    $map['qishu'] = input('param.qishu');
    $map['content'] = input('param.content');
    $map['zhaiyao'] = input('param.zhaiyao');
    $map['xu'] = input('param.xu');
    $map['k_title'] = input('param.k_title');
    $map['k_key'] = input('param.k_key');
    $map['k_cop'] = input('param.k_cop');
     if(!empty($_FILES['uploadfile']['name'])){ 
          $map['img'] = $this->uploadC(request()->file('uploadfile'));
            }else{
          $map['img'] = input('param.img');
            }
    $res = Db::name('zhoukan')->where('id='.$id)->update($map);
    if($res){
   return 1;
  }else{
  return 0;
    }
 }else{
  $pid = input('param.pid');
  $sqlone = Db::name('zhoukan')->where('id='.$pid)->find();
  $this->assign('data',$sqlone);
  return $this->fetch();
 }
}

public function product_downn(){
    if(request()->isAjax()){
        $ids = input('param.ids');
        $map['id'] = $ids;
        $map['statu'] = 0;
        $res = Db::name('zhoukan')->update($map);
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
        $res = Db::name('zhoukan')->update($map);
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
        $res = Db::name('zhoukan')->update($map);
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
        $res = Db::name('zhoukan')->update($map);
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
        $res = Db::name('shuji')->update($map);
        if($res){
         return 1;
        }else{
          return 0;
        }    
    }
  }
}