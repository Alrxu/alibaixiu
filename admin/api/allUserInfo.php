<?php
include_once"../../phpTools.php";
$sql="select * from users";
$arr=excute_select($sql);
echo json_encode($arr);
?>