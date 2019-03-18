<?php
/**
 * Created by PhpStorm.
 * User: xc
 * Date: 2018/3/12
 * Time: 17:12
 */
/**
 *@删除编辑器里面的图片
 *@pragram $content string 要删除的字符串
 *@return null
 *@author karl
 */
function delContentPic($content){
    $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
    preg_match_all($pattern,$content,$match);//把匹配正则表达式的内容找出来
    if(!empty($match[1])){
        for($i=0;$i<count($match[1]);$i++){
            $a = substr($match[1][$i],stripos($match[1][$i],'Public'));
            unlink('./'.$a);
        }
    }
}

/**
 *@修改编辑器里面的图片
 *@pragram $content1 string 原来的字符串
 *@pragram $content2 string 修改后的字符串
 *@return null
 *@author karl
 */
function editContentPic($content1,$content2){
    $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
    preg_match_all($pattern,$content1,$match);//把匹配正则表达式的内容找出来
    preg_match_all($pattern,$content2,$mat);
    $res=array_diff($match[1],$mat[1]);
    if(!empty($res)){
        for($i=0;$i<count($res);$i++){
            $a = substr($res[$i],stripos($res[$i],'Public'));
            unlink('./'.$a);
        }
    }
}

/**
 *@图片上传
 *@pragram $content1 string 原来的字符串
 *@return $path 图片保存路径
 *@author karl
 */
function uploadPic($file){
     $info = $file->validate(['size'=>15678,'ext'=>'jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'uploads');
     var_dump($info);

    if(!$info) {
        // 上传错误提示错误信息
        echo $file->getError(); exit;
    }else{
        // 上传成功 获取上传文件信息
        //return '/Uploads'.$info['savepath'].$info['savename'];
    }
}

/**
 *@图片上传
 *@pragram $content1 string 原来的字符串
 *@return $path 图片保存路径
 *@author karl
 */
function uploadFile($file){
    $upload = new \Think\Upload();// 实例化上传类
    $upload->maxSize   =     314572800 ;// 设置附件上传大小
    $upload->exts      =     array('rar', 'pdf', 'zip');// 设置附件上传类型
    $upload->savePath  =      '/file/'; // 设置附件上传目录
    // 上传单个文件
    $info   =   $upload->uploadOne($_FILES[$file]);
    if(!$info) {
        // 上传错误提示错误信息
        echo $upload->getError(); exit;
    }else{
        // 上传成功 获取上传文件信息
        return '/Uploads'.$info['savepath'].$info['savename'];
    }
}

 


/**
 * 无限级分类
 * @param $data     //数据库里获取的结果集
 * @param Int $pid
 * @param Int $count       //第几级分类
 * @return Array $treeList
 */
function tree($data,&$treeList=array(),$pid=0,$count=0){
    foreach ($data as $key => $value){
        if($value['pid']==$pid){
            /*$value['path'] = $count;*/
            $value['name'] = str_repeat('&nbsp;&nbsp;',$count).$value['name'];
            $treeList[]=$value;
            unset($data[$key]);
            tree($data,$treeList,$value['id'],$count+1);
        }
    }
    return $treeList ;
}

/**
 * 文件下载
 * @param $file_dir     //文件的相对路径
 * @param $file_name    下载后生成的文件名
 * @return null
 */

function file_down($file_dir,$file_name){
    if (! file_exists ( $file_dir)) {
        echo "文件找不到";
        exit ();
    } else {
        //打开文件
        $file = fopen ( $file_dir, "r" );
        //输入文件标签
        Header ( "Content-type: application/octet-stream" );
        Header ( "Accept-Ranges: bytes" );
        Header ( "Accept-Length: " . filesize ( $file_dir) );
        Header ( "Content-Disposition: attachment; filename=" . $file_name );
        //输出文件内容
        //读取文件内容并直接输出到浏览器
        echo fread ( $file, filesize ( $file_dir));
        fclose ( $file );
        exit ();
    }
}
/**
 * 发送模板短信
 * @param mobile 手机号码集合,用英文逗号分开
 * @param contents 内容数据 格式为数组 例如：array('Marry','Alon')，如不需替换请填 null
 * @param $status 模板Id,测试应用和未上线应用使用测试模板请填写1，正式应用上线后填写已申请审核通过的模板ID
 */
function SendSMS($mobile,$contents,$status){
    Vendor('ChuanglanSmsHelper/ChuanglanSmsApi');
    $clapi  = new \ChuanglanSmsApi();
    $result = $clapi->sendSMS($mobile, $contents,$status);
    $result = $clapi->execResult($result);
    return $result[1];
}
/*
 *随机生成六位数字验证码
 *
 */
 function generate_code($length = 6) {
     return rand(pow(10,($length-1)), pow(10,$length)-1);
 }
/**
 * 验证是否是手机号码
 *
 * @param string $phone 待验证的号码
 * @return boolean 如果验证失败返回false,验证成功返回true
 */
function isTelNumber($phone) {
    if (strlen ( $phone ) != 11 || ! preg_match ( '/^1[3|4|5|7|8][0-9]\d{4,8}$/', $phone )) {
        return false;
    } else {
        return true;
    }
}

/*
 *获取客户端IP
 */
function get_member_ip($type = 0) {
    $type    = $type ? 1 : 0;
    static $ip =  NULL;
    if ($ip !== NULL) return $ip[$type];
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $arr  =  explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $pos  =  array_search('unknown',$arr);
        if(false !== $pos) unset($arr[$pos]);
        $ip   =  trim($arr[0]);
    }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip   =  $_SERVER['HTTP_CLIENT_IP'];
    }elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip   =  $_SERVER['REMOTE_ADDR'];
    }
    // IP地址合法验证
    $long = ip2long($ip);
    $ip  = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];
}
/**
 * 是否移动端访问访问
 *
 * @return bool
 */
function isMobile(){
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE'])){
        return true;
    }
    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset ($_SERVER['HTTP_VIA'])){
        // 找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    }
    // 脑残法，判断手机发送的客户端标志,兼容性有待提高
    if (isset ($_SERVER['HTTP_USER_AGENT'])){
        $clientkeywords = array ('nokia', 'sony', 'ericsson', 'mot','samsung', 'htc', 'sgh','lg', 'sharp', 'sie-', 'philips', 'panasonic', 'alcatel', 'lenovo', 'iphone','ipod', 'blackberry', 'meizu', 'android', 'netfront', 'symbian', 'ucweb', 'windowsce', 'palm','operamini','operamobi', 'openwave','nexusone', 'cldc', 'midp', 'wap', 'mobile');
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))){
            return true;
        }
    }
    // 协议法，因为有可能不准确，放到最后判断
    if (isset ($_SERVER['HTTP_ACCEPT'])){
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))){
            return true;
        }
    }
    return false;
}


/*
Utf-8、gb2312都支持的汉字截取函数
cut_str(字符串, 截取长度, 开始长度, 编码);
编码默认为 utf-8
开始长度默认为 0
*/

function cut_str($string, $sublen, $start = 0, $code = 'UTF-8')
{
    if($code == 'UTF-8')
    {
        $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
        preg_match_all($pa, $string, $t_string);

        if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen))."...";
        return join('', array_slice($t_string[0], $start, $sublen));
    }
    else
    {
        $start = $start*2;
        $sublen = $sublen*2;
        $strlen = strlen($string);
        $tmpstr = '';

        for($i=0; $i< $strlen; $i++)
        {
            if($i>=$start && $i< ($start+$sublen))
            {
                if(ord(substr($string, $i, 1))>129)
                {
                    $tmpstr.= substr($string, $i, 2);
                }
                else
                {
                    $tmpstr.= substr($string, $i, 1);
                }
            }
            if(ord(substr($string, $i, 1))>129) $i++;
        }
        if(strlen($tmpstr)< $strlen ) $tmpstr.= "...";
        return $tmpstr;
    }
}

//获取文件修改时间
function getfiletime($file, $DataDir) {
    $a = filemtime($DataDir . $file);
    $time = date("Y-m-d H:i:s", $a);
    return $time;
}

//获取文件的大小
function getfilesize($file, $DataDir) {
    $perms = stat($DataDir . $file);
    $size = $perms['size'];
    // 单位自动转换函数
    $kb = 1024;         // Kilobyte
    $mb = 1024 * $kb;   // Megabyte
    $gb = 1024 * $mb;   // Gigabyte
    $tb = 1024 * $gb;   // Terabyte

    if ($size < $kb) {
        return $size . " B";
    } else if ($size < $mb) {
        return round($size / $kb, 2) . " KB";
    } else if ($size < $gb) {
        return round($size / $mb, 2) . " MB";
    } else if ($size < $tb) {
        return round($size / $gb, 2) . " GB";
    } else {
        return round($size / $tb, 2) . " TB";
    }



  

}