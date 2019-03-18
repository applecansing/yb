<?php
namespace app\admin\controller;
use think\Db;
use think\Request;
class Lyb extends Conmmon{
  //查询
public function index(){
    	$list = Db::name('liuyan')->order('id desc')->select();
    	$this->assign('data',$list);
    	$this->assign('count',count($list));
        return $this->fetch();
    }

//删除
  public function del(){
        $id = input('param.id');
        if(Request::instance()->isPost() && $id) {
          $all = Db::name('liuyan')->delete($id);
          if($all){

                return 1;
          }else{

                return 0;
          } 
          return 0 ;   
        }   
  }

 }