<?php
namespace app\admin\controller;
use think\Db;
use think\Request;
class Title extends Conmmon{
   public function edit(){
       if(Request::instance()->isPost()){
                $id = input('param.id');
                $map = input('param.');
           $res =  Db::name('title')->where('id ='.$id)->update($map);
           if($res){
              return 1;
                 }else{ 
                return 0; 
           }
       
    }else{

        $pid = input('param.id');       
        $res = Db::name('title')->order('id desc')->find();
        $this->assign('data',$res);
         return $this->fetch();
    }

    }
}