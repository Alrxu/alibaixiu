<?php

$id=$_POST['id'];
include_once"../../phpTools.php";
$sql="delete from users where id in ($id)";
$rows=excute_zsg($sql);
if($rows){
    echo"ok";
}else{
    echo"fail";
}
?>