<?php
$slider=$_POST['slider'];
// 连接数据库,修改操作
include_once"../../phpTools.php";
$sql="update options set value='$slider' where id=10";
$rows=excute_zsg($sql);
if($rows){
    echo"ok";
}else{
    echo"fail";
}
?>