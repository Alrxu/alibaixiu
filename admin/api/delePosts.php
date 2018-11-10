<?php

// 获取到传递过来的id
$id=$_POST['id'];

//连接数据库修改status为trashed
include_once"./../../phpTools.php";
$sql="update posts set status='trashed' where id in ($id)";
$rows=excute_zsg($sql);
if($rows){
    echo"ok";
}else{
    echo"fail";
}

?>