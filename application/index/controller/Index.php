<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Page;
class Index extends Controller{
 public function index(){
 $banner = Db::name('banner')->order('xu desc')->where("status = 1")->limit(3)->select();
 $this->assign('banner',$banner);
 $peixun = Db::name('peixun')->order('xu desc')->where("status = 1 and statu = 1")->limit(5)->select();
 $this->assign('peixun',$peixun);
 $wenzhang = Db::name('wenzhang')->order('xu desc')->where("status = 1 and statu = 1")->limit(5)->select();
 $this->assign('wenzhang',$wenzhang);
 $video = Db::name('video')->order('xu desc')->where("status = 1 and statu = 1")->find();
 $this->assign('video',$video);
 $product = Db::name('product')->order('xu desc')->where("status = 1 and statu = 1")->limit(5)->select();
 $this->assign('product',$product);

 $shuji = Db::name('shuji')->order('xu desc')->where("status = 1 and statu = 1")->limit(2)->select();
 $this->assign('shuji',$shuji);
  $zhoukan = Db::name('zhoukan')->order('xu desc')->where("status = 1 and statu = 1")->limit(2)->select();
 $this->assign('zhoukan',$zhoukan);
 $news = Db::name('news')->order('xu desc')->where("status = 1 and statu = 1")->limit(12)->select();
 $this->assign('news',$news);
$newsfa = Db::name('news_fa')->order('xu desc')->where("status = 1 and statu = 1")->limit(12)->select();
 $this->assign('newsfa',$newsfa);
 $ppp = Db::name('ppp')->find();
 $this->assign('ppp',$ppp);
 $rong = Db::name('rong')->find();
 $this->assign('rong',$rong);
 $zhou = Db::name('zhou')->find();
 $this->assign('zhou',$zhou);
 $title = Db::name('title')->find();
 $this->assign('title',$title);
 return $this->fetch();
 }
 //关于我们
public function about(){
 $about = Db::name('about')->find();
 $this->assign('about',$about);
 $ppp = Db::name('ppp')->find();
 $this->assign('ppp',$ppp);
 $rong = Db::name('rong')->find();
 $this->assign('rong',$rong);
 $zhou = Db::name('zhou')->find();
 $this->assign('zhou',$zhou);
 $title = Db::name('title')->find();
 $this->assign('title',$title);
return $this->fetch();	
}
//产品中心
public function product(){
 $type = Db::name('product_type')->order('xu desc')->select();
 $this->assign('type',$type);
 $id = input('param.id');
 
 if(empty($id)){
 	$id = $type[0]['id'];
 }
    $this->assign('id',$id);
 	$prod = Db::name('product')->where('pid ='.$id)->order('xu desc')->paginate(5);
    $page = $prod->render();
    $this->assign('page',$page);
    $this->assign('prod',$prod);
 

 $ppp = Db::name('ppp')->find();
 $this->assign('ppp',$ppp);
 $rong = Db::name('rong')->find();
 $this->assign('rong',$rong);
 $zhou = Db::name('zhou')->find();
 $this->assign('zhou',$zhou);
 $title = Db::name('title')->find();
 $this->assign('title',$title);
 return $this->fetch();
}
public function productdata(){
 $type = Db::name('product_type')->order('xu desc')->select();
 $this->assign('type',$type);
 $id = input('param.id');
 $this->assign('id',$id);
 $uct = Db::name('product')->where('id='.$id)->find();
 $this->assign('uct',$uct);
 $ppp = Db::name('ppp')->find();
 $this->assign('ppp',$ppp);
 $rong = Db::name('rong')->find();
 $this->assign('rong',$rong);
 $zhou = Db::name('zhou')->find();
 $this->assign('zhou',$zhou);
 $title = Db::name('title')->find();
 $this->assign('title',$title);
 return $this->fetch();

}


//专业服务
public function server(){

 $sheng = Db::name('sheng')->find();
 $this->assign('sheng',$sheng);
 $ppp = Db::name('ppp')->find();
 $this->assign('ppp',$ppp);
 $rong = Db::name('rong')->find();
 $this->assign('rong',$rong);
 $zhou = Db::name('zhou')->find();
 $this->assign('zhou',$zhou);
 $title = Db::name('title')->find();
 $this->assign('title',$title);
 return $this->fetch();

}

public function gongcheng(){
  
 $gongcheng = Db::name('gongcheng')->find();
 $this->assign('gongcheng',$gongcheng);
 $ppp = Db::name('ppp')->find();
 $this->assign('ppp',$ppp);
 $rong = Db::name('rong')->find();
 $this->assign('rong',$rong);
 $zhou = Db::name('zhou')->find();
 $this->assign('zhou',$zhou);
 $title = Db::name('title')->find();
 $this->assign('title',$title);
 return $this->fetch();
}

//机构智慧

public function wisdom(){

 $list = Db::name('wenzhang')->where('status=1')->order('xu desc')->paginate(6);
 $page = $list->render();
 $this->assign('page',$page);
 $this->assign('list',$list);
 $ppp = Db::name('ppp')->find();
 $this->assign('ppp',$ppp);
 $rong = Db::name('rong')->find();
 $this->assign('rong',$rong);
 $zhou = Db::name('zhou')->find();
 $this->assign('zhou',$zhou);
 $title = Db::name('title')->find();
 $this->assign('title',$title);
return $this->fetch();	
}
public function wisdomdata(){
 $id = input('param.id');
 $row = Db::name('wenzhang')->where('id='.$id)->find();
 $this->assign('row',$row);
 $ppp = Db::name('ppp')->find();
 $this->assign('ppp',$ppp);
 $rong = Db::name('rong')->find();
 $this->assign('rong',$rong);
 $zhou = Db::name('zhou')->find();
 $this->assign('zhou',$zhou);
 $title = Db::name('title')->find();
 $this->assign('title',$title);
return $this->fetch();	
}

public function forum(){
 $listone = Db::name('peixun')->where('status=1')->order('xu desc')->paginate(6);
 $page = $listone->render();
 $this->assign('page',$page);
 $this->assign('listone',$listone);
 $ppp = Db::name('ppp')->find();
 $this->assign('ppp',$ppp);
 $rong = Db::name('rong')->find();
 $this->assign('rong',$rong);
 $zhou = Db::name('zhou')->find();
 $this->assign('zhou',$zhou);
 $title = Db::name('title')->find();
 $this->assign('title',$title);
 return $this->fetch();
}

public function forumdata(){
 $id = input('param.id');
 $row = Db::name('peixun')->where('id='.$id)->find();
 $this->assign('row',$row);
 $ppp = Db::name('ppp')->find();
 $this->assign('ppp',$ppp);
 $rong = Db::name('rong')->find();
 $this->assign('rong',$rong);
 $zhou = Db::name('zhou')->find();
 $this->assign('zhou',$zhou);
 $title = Db::name('title')->find();
 $this->assign('title',$title);
 return $this->fetch();
}
public function video(){
 $listuo = Db::name('video')->order('xu desc')->where('status=1')->paginate(8);
 $page = $listuo->render();
 $this->assign('page',$page);
 $this->assign('listuo',$listuo);
 $ppp = Db::name('ppp')->find();
 $this->assign('ppp',$ppp);
 $rong = Db::name('rong')->find();
 $this->assign('rong',$rong);
 $zhou = Db::name('zhou')->find();
 $this->assign('zhou',$zhou);
 $title = Db::name('title')->find();
 $this->assign('title',$title);
 return $this->fetch();	
}
public function books(){
 $listshui = Db::name('shuji')->order('xu desc')->where('status = 1')->paginate(6);
 $page = $listshui->render();
 $this->assign('page',$page);
 $this->assign('listshui',$listshui);
 $ppp = Db::name('ppp')->find();
 $this->assign('ppp',$ppp);
 $rong = Db::name('rong')->find();
 $this->assign('rong',$rong);
 $zhou = Db::name('zhou')->find();
 $this->assign('zhou',$zhou);
 $title = Db::name('title')->find();
 $this->assign('title',$title);
 return $this->fetch();	
}

public function period(){
 $listfor = Db::name('zhoukan')->order('xu desc')->where('status = 1')->paginate(2);
 $page = $listfor->render();
 $this->assign('page',$page);
 $this->assign('listfor',$listfor);
 $ppp = Db::name('ppp')->find();
 $this->assign('ppp',$ppp);
 $rong = Db::name('rong')->find();
 $this->assign('rong',$rong);
 $zhou = Db::name('zhou')->find();
 $this->assign('zhou',$zhou);
 $title = Db::name('title')->find();
 $this->assign('title',$title);
 return $this->fetch();	
}
public function booksdata(){
 $id = input('param.id');
 $row = Db::name('shuji')->where('id='.$id)->find();
 $this->assign('row',$row);
 $ppp = Db::name('ppp')->find();
 $this->assign('ppp',$ppp);
 $rong = Db::name('rong')->find();
 $this->assign('rong',$rong);
 $zhou = Db::name('zhou')->find();
 $this->assign('zhou',$zhou);
 $title = Db::name('title')->find();
 $this->assign('title',$title);
 return $this->fetch();
}

public function team(){
 $listsix = Db::name('tuan')->order('xu desc')->where('status = 1')->paginate(8);
 $page = $listsix->render();
 $this->assign('page',$page);
 $this->assign('listsix',$listsix);
 $ppp = Db::name('ppp')->find();
 $this->assign('ppp',$ppp);
 $rong = Db::name('rong')->find();
 $this->assign('rong',$rong);
 $zhou = Db::name('zhou')->find();
 $this->assign('zhou',$zhou);
 $title = Db::name('title')->find();
 $this->assign('title',$title);
return $this->fetch();	
}
public function teamdata(){
 $id = input('param.id');
 $row = Db::name('tuan')->where('id='.$id)->find();
 $this->assign('row',$row);
 $ppp = Db::name('ppp')->find();
 $this->assign('ppp',$ppp);
 $rong = Db::name('rong')->find();
 $this->assign('rong',$rong);
 $zhou = Db::name('zhou')->find();
 $this->assign('zhou',$zhou);
 $title = Db::name('title')->find();
 $this->assign('title',$title);
 return $this->fetch();
}


public function joinus(){
 $jigou = Db::name('jigou')->find();
 $this->assign('jigou',$jigou);
 $ppp = Db::name('ppp')->find();
 $this->assign('ppp',$ppp);
 $rong = Db::name('rong')->find();
 $this->assign('rong',$rong);
 $zhou = Db::name('zhou')->find();
 $this->assign('zhou',$zhou);
 $title = Db::name('title')->find();
 $this->assign('title',$title);
return $this->fetch();
}
public function contact(){
 $contact = Db::name('contact')->find();
 $this->assign('contact',$contact);
 $ppp = Db::name('ppp')->find();
 $this->assign('ppp',$ppp);
 $rong = Db::name('rong')->find();
 $this->assign('rong',$rong);
 $zhou = Db::name('zhou')->find();
 $this->assign('zhou',$zhou);
 $title = Db::name('title')->find();
 $this->assign('title',$title);
return $this->fetch();	
}
public function news(){
 $type = Db::name('news')->order('xu desc')->where('status = 1')->paginate(5);
 $page = $type->render();
 $this->assign('page',$page);
 $this->assign('type',$type);
 $ppp = Db::name('ppp')->find();
 $this->assign('ppp',$ppp);
 $rong = Db::name('rong')->find();
 $this->assign('rong',$rong);
 $zhou = Db::name('zhou')->find();
 $this->assign('zhou',$zhou);
 $title = Db::name('title')->find();
 $this->assign('title',$title);
 return $this->fetch();	
}
public function newsdata(){
 $id = input('param.id');
 $row = Db::name('news')->where('id='.$id)->find();
 $this->assign('row',$row);
 $ppp = Db::name('ppp')->find();
 $this->assign('ppp',$ppp);
 $rong = Db::name('rong')->find();
 $this->assign('rong',$rong);
 $zhou = Db::name('zhou')->find();
 $this->assign('zhou',$zhou);
 $title = Db::name('title')->find();
 $this->assign('title',$title);
 return $this->fetch();
}


public function newss(){
 $typeone = Db::name('news_fa')->order('xu desc')->where('status = 1')->paginate(5);
 $page = $typeone->render();
 $this->assign('page',$page);
 $this->assign('typeone',$typeone);
 $ppp = Db::name('ppp')->find();
 $this->assign('ppp',$ppp);
 $rong = Db::name('rong')->find();
 $this->assign('rong',$rong);
 $zhou = Db::name('zhou')->find();
 $this->assign('zhou',$zhou);
 $title = Db::name('title')->find();
 $this->assign('title',$title);
 return $this->fetch();	
}
public function newssdata(){
 $id = input('param.id');
 $row = Db::name('news_fa')->where('id='.$id)->find();
 $this->assign('row',$row);
 $ppp = Db::name('ppp')->find();
 $this->assign('ppp',$ppp);
 $rong = Db::name('rong')->find();
 $this->assign('rong',$rong);
 $zhou = Db::name('zhou')->find();
 $this->assign('zhou',$zhou);
 $title = Db::name('title')->find();
 $this->assign('title',$title);
 return $this->fetch();


}


}