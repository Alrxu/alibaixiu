<?php
include_once"./../../phpTools.php";
$sql="select * from categories";
$arr=excute_select($sql);
echo json_encode($arr);
?>