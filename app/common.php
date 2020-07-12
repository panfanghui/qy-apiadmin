<?php
// 应用公共文件
function fetchJson($data=[],$msg='获取成功',$code=0){
    return Json([
        'code'=>$code,
        'data'=>$data,
        'msg'=>$msg
    ]);
}
function p($arr=[]){
    print_r("<pre>");
    print_r($arr);
}
//引用算法
function generateTree($array=[],$pid='pid',$children='children'){
    //第一步 构造数据
    $items = array();
    foreach($array as $value){
        $items[$value['id']] = $value;
    }
    //第二部 遍历数据 生成树状结构
    $tree = array();
    foreach($items as $key => $value){
        if(isset($items[$value[$pid]])){
            $items[$value[$pid]][$children][] = &$items[$key];
        }else{
            $tree[] = &$items[$key];
        }
    }
    return $tree;
}

//对emoji表情转反义
function emoji_decode($str){
    $strDecode = preg_replace_callback('|\[\[EMOJI:(.*?)\]\]|', function($matches){
        return rawurldecode($matches[1]);
    }, $str);
    return $strDecode;
}

//获取七天日期
//day
function getServenDay($getday="",$com=true)
{
     if($getday=='hotel'){
        $getday='';
    }  
    empty($getday) ? $time=time() : $time=strtotime($getday);

    $weekarray=array("日","一","二","三","四","五","六");

    if($com){ //未来7天            
        for($i=0;$i<7;$i++){
            $t = $time+24*60*60*$i;
            $d=date('d',$t).'/'.$weekarray[date("w",$t)];            
            $day[]=array('time'=>date('Y-m-d',$t),'date'=>$d,'timenum'=>$t);
        }
        return $day;
    }else{ //过去7天
        for($i=7;$i>0;$i--){
            $t = $time-24*60*60*$i;
            $d=date('d',$t).'/'.$weekarray[date("w",$t)];            
            $day[]=array('time'=>date('Y-m-d',$t),'date'=>$d,'timenum'=>$t);
        }
        return $day;
    }
}

//获取上下二天
function getDay($attr)
{
    $dayinfo=[];
    $day=empty($attr['day']) ? null : $attr['day'];    
    switch ($day) {
        case 'oldserven':
             $time=empty($attr['time']) ? null : $attr['time']; 
             $dayinfo=getServenDay($time,false);             
            break;
        case 'goserven':
            $time=empty($attr['time']) ? null : date('Y-m-d',strtotime($attr['time'])+24*60*60); 
            $dayinfo=getServenDay($time);
            break;
        default:
            $dayinfo=getServenDay($day);      
            break;
    }    

    return $dayinfo;
}
//去重
function assoc_unique($arr, $key) {
    $tmp_arr = array();
    foreach ($arr as $k => $v) {
    if (in_array($v[$key], $tmp_arr)) {//搜索$v[$key]是否在$tmp_arr数组中存在，若存在返回true
        unset($arr[$k]);
    } else {
        $tmp_arr[] = $v[$key];
    }
}
    sort($arr); //sort函数对数组进行排序
    return $arr;
}
/**

 * CURL请求

 * @param $url 请求url地址

 * @param $method 请求方法 get post

 * @param null $postfields post数据数组

 * @param array $headers 请求header信息

 * @param bool|false $debug 调试开启 默认false

 * @return mixed

 */

function httpRequest($url, $method = "GET", $postfields = null, $headers = array(), $debug = false)

{

    $method = strtoupper($method);

    $ci = curl_init();

    /* Curl settings */

    curl_setopt($ci, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);//版本

    curl_setopt($ci, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.2; WOW64; rv:34.0) Gecko/20100101 Firefox/34.0");//在HTTP请求中包含一个"User-Agent: "头的字符串。

    curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 60); /* 在发起连接前等待的时间，如果设置为0，则无限等待 */

    curl_setopt($ci, CURLOPT_TIMEOUT, 7); /* 设置cURL允许执行的最长秒数 */

    curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);//将curl_exec()获取的信息以文件流的形式返回，而不是直接输出。

    switch ($method) {

        case "POST":

            curl_setopt($ci, CURLOPT_POST, true);//启用时会发送一个常规的POST请求，类型为：application/x-www-form-urlencoded，就像表单提交的一样。

            if (!empty($postfields)) {

                $tmpdatastr = is_array($postfields) ? http_build_query($postfields) : $postfields;

                curl_setopt($ci, CURLOPT_POSTFIELDS, $tmpdatastr);

            }

            break;

        default:

            curl_setopt($ci, CURLOPT_CUSTOMREQUEST, $method); /* //设置请求方式 */

            break;

    }

    $ssl = preg_match('/^https:\/\//i', $url) ? TRUE : FALSE;

    curl_setopt($ci, CURLOPT_URL, $url);//需要获取的URL地址，也可以在curl_init()函数中设置

    if ($ssl) {

        curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts

        curl_setopt($ci, CURLOPT_SSL_VERIFYHOST, FALSE); // 不从证书中检查SSL加密算法是否存在

    }

    //curl_setopt($ci, CURLOPT_HEADER, true); /*启用时会将头文件的信息作为数据流输出*/

    curl_setopt($ci, CURLOPT_FOLLOWLOCATION, 1);

    curl_setopt($ci, CURLOPT_MAXREDIRS, 2);/*指定最多的HTTP重定向的数量，这个选项是和CURLOPT_FOLLOWLOCATION一起使用的*/

    curl_setopt($ci, CURLOPT_HTTPHEADER, $headers);

    curl_setopt($ci, CURLINFO_HEADER_OUT, true);

    /*curl_setopt($ci, CURLOPT_COOKIE, $Cookiestr); * *COOKIE带过去** */

    $response = curl_exec($ci);

    $requestinfo = curl_getinfo($ci);

    if ($debug) {

 

        $html = <<<HTML

        <style>

            *{

            margin:0;

            padding:0;

            font-family: "微软雅黑 Light";

            color:#777; 

            }

            body{

            padding:10px;

            }

            h1{

            border:1px solid #CCCCCC;

            height: 40px;

            line-height: 40px;

            font-size: 20px;

            border-radius: 5px;

            text-align: center;

            background: #F5F5F5;

            }

            p.box{

                padding:10px 0;

            }

            p.line{

            height: 30px;

            line-height: 30px;

            border-bottom: 1px dashed #ccc;

            overflow: auto;

            }

            p.line:hover{

             background: #EEEEEE;;

             }

            span.title{

            display: inline-block;

            width:300px;

            height: 100%;

            }

            span.key{

            color:red;

            display: inline-block;

            width:200px;

            height: 100%;

            }

        </style>

        <h1>PostData</h1>

        <p class="box">

HTML;

        $i = 1;

        foreach ($postfields as $key => $value) {

            $html .= " <p class=\"line\"><span class='key'>{$i}</span><span class=\"title\">{$key}:</span> <span>{$value}</span></p>";

            $i++;

        }

        $html .= <<<HTML

        </p>

        <h1>Info</h1>

            <p class="box">

HTML;

        $i = 1;

        foreach ($requestinfo as $kye => $value) {

            if (is_array($value)) continue;

            $html .= " <p class=\"line\"><span class='key'>{$i}</span><span class=\"title\">{$kye}:</span> <span>{$value}</span></p>";

            $i++;

        }

        $html .= <<<HTML

            </p>

        <h1>Response</h1>

        <p class="box">

            {$response}

        </p>

<p>

HTML;

 

        $html .= <<<HTML

</p>

HTML;

        echo $html;

    }

    curl_close($ci);

    return $response;

}
/**
     * 方图转圆形
     * @param string $original_path 图片地址
     * @param string $destFolder 保存的图片路径
     * @return string
     */
    function roundImg($original_path = '', $destFolder = './')
    {
        //获取参数
        $types = array(1 => "gif", 2 => "jpeg", 3 => "png");//图片类型
        list($width1, $height1, $type1) = getimagesize($original_path);
    
        $createBgImg1 = "imagecreatefrom" . $types[$type1];
        $viceImage = $createBgImg1($original_path);//1:读取文件对象
        
        $w = imagesx($viceImage);//读取副图文件的宽高
        $h = imagesy($viceImage);
 
        if (!file_exists($destFolder)) {
            mkdir($destFolder, 0777, true);
        }
    
        $dest_path = $destFolder;
        $src = imagecreatefromstring(file_get_contents($original_path));
        $newpic = imagecreatetruecolor($w, $h);
        imagealphablending($newpic, false);
        $transparent = imagecolorallocatealpha($newpic, 255, 255, 255, 127);
        $r = $w / 2;
        for ($x = 0; $x < $w; $x++) {
            for ($y = 0; $y < $h; $y++) {
                $c = imagecolorat($src, $x, $y);
                $_x = $x - $w / 2;
                $_y = $y - $h / 2;
                if ((($_x * $_x) + ($_y * $_y)) < ($r * $r)) {
                    imagesetpixel($newpic, $x, $y, $c);
                } else {
                    imagesetpixel($newpic, $x, $y, $transparent);
                }
            }
        }
 
        imagesavealpha($newpic, true);
        imagepng($newpic, $dest_path);
        imagedestroy($newpic);
        imagedestroy($src);
        imagedestroy($viceImage);
        return $dest_path;
    }
    
    /**
     * 将图片四直角处理成圆角
     *
     * @param $src_img 目标图片
     * @param $width 宽
     * @param $height 高
     * @param int $radius 圆角半径
     * @return resource
     */
    function radiusImg($src_img, $width,$height, $radius = 17) {
        $w  = &$width;
        $h  = &$height;
        $img = imagecreatetruecolor($w, $h);//创建底图
        //这一句一定要有
        imagesavealpha($img, true);//设置是否保存透明图像资源
        
        //拾取一个完全透明的颜色,最后一个参数127为全透明
        $bg = imagecolorallocatealpha($img, 255, 255, 255, 127);
        imagefill($img, 0, 0, $bg);
        
        $r = $radius; //圆角半径
        for ($x = 0; $x < $w; $x++) {
            for ($y = 0; $y < $h; $y++) {
                $rgbColor = imagecolorat($src_img, $x, $y);
                if (($x >= $radius && $x <= ($w - $radius)) || ($y >= $radius && $y <= ($h - $radius))) {
                    //不在四角的范围内,直接画
                    imagesetpixel($img, $x, $y, $rgbColor);
                } else {
                    //在四角的范围内选择画
                    //上左
                    $y_x = $r; //圆心X坐标
                    $y_y = $r; //圆心Y坐标
                    if (((($x - $y_x) * ($x - $y_x) + ($y - $y_y) * ($y - $y_y)) <= ($r * $r))) {
                        imagesetpixel($img, $x, $y, $rgbColor);
                    }
                    //上右
                    $y_x = $w - $r; //圆心X坐标
                    $y_y = $r; //圆心Y坐标
                    if (((($x - $y_x) * ($x - $y_x) + ($y - $y_y) * ($y - $y_y)) <= ($r * $r))) {
                        imagesetpixel($img, $x, $y, $rgbColor);
                    }
                    //下左
                    $y_x = $r; //圆心X坐标
                    $y_y = $h - $r; //圆心Y坐标
                    if (((($x - $y_x) * ($x - $y_x) + ($y - $y_y) * ($y - $y_y)) <= ($r * $r))) {
                        imagesetpixel($img, $x, $y, $rgbColor);
                    }
                    //下右
                    $y_x = $w - $r; //圆心X坐标
                    $y_y = $h - $r; //圆心Y坐标
                    if (((($x - $y_x) * ($x - $y_x) + ($y - $y_y) * ($y - $y_y)) <= ($r * $r))) {
                        imagesetpixel($img, $x, $y, $rgbColor);
                    }
                }
            }
        }
        
        return $img;
    }
