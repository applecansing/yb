<?php
namespace app\admin\controller;
use think\Db;
use think\Request;
class Products extends Conmmon{
  //查询
public function index(){
    	$list = Db::name('product_type')->order('xu desc')->select();
    	$this->assign('data',$list);
    	$this->assign('count',count($list));
        return $this->fetch();
    }
//添加
public function add(){
    	if(request()->isAjax()){
            $map['name'] = input('param.name'); 
            $map['xu'] = input('param.xu');  
            $map['status'] = input('param.status');
            $res = Db::name('product_type')->insert($map);             
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
          $all = Db::name('product_type')->delete($id);
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
           $map['name'] = input('param.name'); 
           $map['xu'] = input('param.xu');  
          $id = input('param.id');
          $res =  Db::name('product_type')->where('id ='.$id)->update($map);
          if($res){
             return 1;
                }else{ 
               return 0; 
           }
        
   }else{
        $pid = input('param.pid');
        $res = Db::name('product_type')->where('id ='.$pid)->find();
            $this->assign('data',$res);
            return $this->fetch();
   }

   }


  public function product_sort(){
    if(request()->isAjax()){
        $map = input('param.');
        $res = Db::name('product_type')->update($map);
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
        $res = Db::name('product_type')->update($map);
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
        $res = Db::name('product_type')->update($map);
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
        $res = Db::name('product_type')->update($map);
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
        $res = Db::name('product_type')->update($map);
        if($res){
         return 1;
        }else{
        return  0;
        }
    }
  }
}
