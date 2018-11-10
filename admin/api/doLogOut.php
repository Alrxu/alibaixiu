<?php
// 点击退出,删除session之后回到登录页面
session_start();
unset($_SESSION['info']);
header('location:./../login.html');
?>