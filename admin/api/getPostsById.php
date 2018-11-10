<?php
//获取到传递过来的id
$postId=$_GET['postId'];
//查询数据库
include_once"./../../phpTools.php";
$sql="select * from posts where id='$postId'";
$data=excute_select($sql);
echo json_encode($data[0]);



?>