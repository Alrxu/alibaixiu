<?php
$status=$_POST['status'];
$id=$_POST['id'];
include_once"./../../phpTools.php";
$sql="update comments set status='$status' where id in ($id)";
$rows=excute_zsg($sql);
if($rows>0){
   echo"ok";
}else{
    echo"fail";
};


