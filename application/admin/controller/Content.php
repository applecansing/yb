<?php
namespace app\admin\controller;
use think\Db;
use think\Request;
class content extends Conmmon{
  //查询
public function index(){
      $list = Db::name('cate_content')->order('id desc')->select();
      foreach($list as &$listv){
        $cate = Db::name('cate')->field('title')->where('id='.$listv['cat_id'])->find();
        $listv['cat_id'] = $cate['title'];
      }
      $list = Db::name('cate_content')->order('id desc')->select();
      foreach($list as &$listv){
        $contitle = Db::name('cate_content')->field('title')->where('id='.$listv['cat_id'])->find();
        $listv['img'] = explode(',',$listv['img']);
      }
      $this->assign('data',$list);
      $this->assign('count',count($list));
      return $this->fetch();
    }
//添加
public function add(){
      if(request()->isAjax()){
        $p = input('param.');
        $map['title'] = $p['title'];
        $map['cat_id'] = $p['cat_id'];
        $map['sheji_time'] = $p['sheji_time'];
        $map['jian_time'] = $p['jian_time'];
        $map['mianji'] = $p['mianji'];
        $map['address'] = $p['address'];
        $map['xu'] = $p['xu'];

        if(!empty($_FILES['uploadfile']['name'])){ 
          $map['f_image'] = $this->uploadC(request()->file('uploadfile'));
           }else{
          $map['f_image'] = '';
           }
         if(!empty($_FILES['uploadfilet']['name'])){ 
             $map['img'] = $this->uploadD(request()->file('uploadfilet'));;
           }else{
          $map['img'] = '';
           }
         $res = Db::name('cate_content')->insert($map);             
        if($res){               
          return 1;
        }else{
          return 0;
        }
      }else{
        $cate = Db::name('cate')->order('xu asc')->select();
        $this->assign('cate',$cate);
        return $this->fetch();
      }
}

//删除
  public function del(){
        $id = input('param.id');
        if(Request::instance()->isPost() && $id) {
          $all = Db::name('cate_content')->delete($id);
          if($all){

                return 1;
          }else{
                return 0;
          } 
          return 0 ;   
        }      
  }

  public function edit(){
      if(request()->isPost()){ 
        $id = input('param.id');
        $p = input('param.');
        $map['title'] = $p['title'];
        $map['sheji_time'] = $p['sheji_time'];
        $map['jian_time'] = $p['jian_time'];
        $map['mianji'] = $p['mianji'];
        $map['address'] = $p['address'];
        $map['xu'] = $p['xu'];
        $where['id'] = $id;
        $url = '';
        $urlOne = '';
        if(!empty($_FILES['uploadfile']['name'])){
          $map['f_image'] = $this->uploadC(request()->file('uploadfile'));
          $urlOne = Db::name('cate_content')->where($where)->value('f_image');
         }else{
          $map['f_image'] = $p['image'];
         }
       
        if(!empty($_FILES['uploadfilet']['name'])){
          $map['img'] = $this->uploadD(request()->file('uploadfilet'));
          $url = Db::name('cate_content')->where($where)->value('img');
        }else{
          $map['img'] = $p['img'];
        }
          $res =  Db::name('cate_content')->where('id ='.$id)->update($map);
          if($res){
             $this->delUnlink($url);
             $this->delUnlink($urlOne);
             return 1;
          }else{ 
               return 1; 
          }
   }else{
        $pid = input('param.pid');
        $res = Db::name('cate_content')->where('id ='.$pid)->find();
        $res['imgUrl'] = explode(',',$res['img']);
        $this->assign('data',$res);
        $cate = Db::name('cate')->order('xu asc')->select();
        $this->assign('cate',$cate);
        return $this->fetch();
   }
   }

      public function show()
   {
       $id = input('param.id');
       if($id){
           $map['id'] = $id;
           $list = Db::name('cate_content')->where($map)->column('img');
           $list['img'] = explode(',',$list[0]);
           unset($list[0]);
           $this->assign('data',$list);
           return $this->fetch();
       }

   }
}
