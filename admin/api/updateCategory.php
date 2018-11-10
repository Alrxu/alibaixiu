<?php
//获取到传递过来的数据
$cateId=$_POST['cateId'];
$name=$_POST['name'];
$slug=$_POST['slug'];
include_once"../../phpTools.php";
$sql="update categories set id='$cateId',name='$name',slug='$slug'";
$rows=excute_zsg($sql);
if($rows){
    echo"ok";
}else{
    echo"fail";
}

?>