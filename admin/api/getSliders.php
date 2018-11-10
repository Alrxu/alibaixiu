<?php
include_once "../../phpTools.php";
$sql = "select value from options where id=10";

$arr = excute_select($sql);
echo $arr[0]['value'];

?>