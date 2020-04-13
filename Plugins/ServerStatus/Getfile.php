<?php
$url = $_GET['url'];
$key = $_GET['key'];
if(empty($url) || empty($key)){
	echo '服务器通讯地址和密匙不完整，请返回重试！';
	exit;
}

require_once('./Pclzip.php');
$file_real = rand_str(6,1,1).'.zip';
$file = dirname(__FILE__)."/log/{$file_real}";

$file_path = dirname(__FILE__)."/other/ServerStatus.php";
$cache_path = dirname(__FILE__)."/log/".md5($url.$key).".php";

//安装包
$file_str = file_get_contents($file_path);
$file_str = str_replace('{ServerStatus_url}',$url,$file_str);
$file_str = str_replace('{ServerStatus_key}',$key,$file_str);
if(!file_exists($cache_path)){
    $fp = fopen($cache_path,'w+');
    fwrite($fp,$file_str);
    fclose($fp);
}

if(file_exists($file)) unlink($file);
if(file_exists($cache_path)) unlink($cache_path);
$zip = new PclZip($file);
$v_list = $zip->add(array(array(PCLZIP_ATT_FILE_NAME => $cache_path,PCLZIP_ATT_FILE_NEW_FULL_NAME => "ServerStatus.php")));

$file_size=filesize("$file");
header("Content-Description: File Transfer");
header("Content-Type:application/force-download");
header("Content-Length: {$file_size}");
header("Content-Disposition:attachment; filename=ServerStatus_{$file_real}");
readfile("$file");
unlink($file);
unlink($cache_path);

function rand_str($randLength = 6, $addtime = 1, $includenumber = 0){
    if($includenumber){
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHJKLMNPQEST123456789';
    }else{
        $chars = 'abcdefghijklmnopqrstuvwxyz';
    }
    $len = strlen($chars);
    $randStr = '';
    for($i = 0;$i < $randLength;$i++){
        $randStr .= $chars[mt_rand(0, $len - 1)];
    }
    $tokenvalue = $randStr;
    if($addtime){
        $tokenvalue = $randStr . time();
    }
    return $tokenvalue;
}
?>