<?php

//从session中获取登录信息
session_start();
$user=$_SESSION['info'];
echo json_encode($user);

?>