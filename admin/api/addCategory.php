<?php
//获取到传递过来的数据
$name=$_POST['name'];
$slug=$_POST['slug'];
include_once"./../../phpTools.php";
$sql="insert into categories(name,slug)values('$name','$slug')";
$rows=excute_zsg($sql);
if($rows){
    echo"ok";
}else{
    echo"fail";
}


?>