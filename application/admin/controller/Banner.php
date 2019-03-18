<?php
namespace app\admin\controller;
use think\Db;
use think\Request;
class Banner extends Conmmon{
  //查询
public function index(){
    	$list = Db::name('banner')->order('xu desc')->select();
    	$this->assign('data',$list);
    	$this->assign('count',count($list));
      return $this->fetch();
    }
//添加
public function add(){
    	if(request()->isAjax()){
             if(!empty($_FILES['uploadfile']['name'])){    
                 $map['img'] = $this->uploadC(request()->file('uploadfile')); 
              }
                $map['xu'] = input('param.xu');  
                $map['status'] = input('param.status');              
                 $res = Db::name('banner')->insert($map);             
                 if($res){               
                       return 1;
                    }else{
                   
                      return 0;
                  }
              }else{
       	           return $this->fetch();
            }
    	
           }
//删除
  public function del(){
        $id = input('param.id');
        if(Request::instance()->isPost() && $id) {
          $all = Db::name('banner')->delete($id);
          if($all){

                return 1;
          }else{
                return 0;
          } 
          return 0 ;   
        }      
  }
   public function edit(){
      if(request()->isAjax()){ 
        $id = input('param.id');
        $map['xu'] = input('param.xu'); 
        if(!empty($_FILES['uploadfile']['name'])){ 
          $map['img'] = $this->uploadC(request()->file('uploadfile'));
            }else{
          $map['img'] = input('param.img');
            }
          $res =  Db::name('banner')->where('id ='.$id)->update($map);
          if($res){
             return 1;
                }else{ 
               return 0; 
           }       
   }else{
        $pid = input('param.pid');
        $res = Db::name('banner')->where('id ='.$pid)->find();
            $this->assign('data',$res);
            return $this->fetch();
   }

   }


 public function product_down(){
    if(request()->isAjax()){
        $ids = input('param.ids');
        $map['id'] = $ids;
        $map['status'] = 0;
        $res = Db::name('banner')->update($map);
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
        $res = Db::name('banner')->update($map);
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
        $res = Db::name('banner')->update($map);
        if($res){
         return 1;
        }else{
          return 0;
        }    
    }
  }
}
