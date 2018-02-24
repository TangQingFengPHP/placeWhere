<?php
header("Content-Type:text/html;charset=UTF-8");
$phoneNum = $_GET['phoneNum'];  //接收传过来的数据
function nowapi_call($a_parm){
    if(!is_array($a_parm)){
        return false;
    }
    //combinations
    $a_parm['format']=empty($a_parm['format'])?'json':$a_parm['format'];
    $apiurl=empty($a_parm['apiurl'])?'http://api.k780.com/?':$a_parm['apiurl'].'/?';
    unset($a_parm['apiurl']);
    foreach($a_parm as $k=>$v){
        $apiurl.=$k.'='.$v.'&';
    }
    $apiurl=substr($apiurl,0,-1);
    if(!$callapi=file_get_contents($apiurl)){
        return false;
    }
    //format
    if($a_parm['format']=='base64'){
        $a_cdata=unserialize(base64_decode($callapi));
    }elseif($a_parm['format']=='json'){
        if(!$a_cdata=json_decode($callapi,true)){
            return false;
        }
    }else{
        return false;
    }
    //array
    if($a_cdata['success']!='1'){
        echo $a_cdata['msgid'].' '.$a_cdata['msg'];
        return false;
    }
    return $a_cdata['result'];
}
$nowapi_parm['app']='phone.get';
$nowapi_parm['phone']= $phoneNum;
$nowapi_parm['appkey']='31764';
$nowapi_parm['sign']='1c19f405d860c88a9528fc57a57b72dc';
$nowapi_parm['format']='json';
$result=nowapi_call($nowapi_parm);
echo json_encode($result);
