<?php

// 获取到传递过来的数据
$id=$_POST['id'];
include_once"../../phpTools.php";
$sql="delete from categories where id in ($id)";
$rows=excute_zsg($sql);
if($rows){
    echo"ok";
}else{
    echo"fail";
}

?>