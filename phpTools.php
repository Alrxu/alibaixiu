<?php

//增删改
function excute_zsg($sql){
    //1.连接数据库
    $link = mysqli_connect('127.0.0.1','root','root','baixiu');
    //2.执行sql语句
    $rows = mysqli_query($link,$sql); //执行的sql语句通过参数传递过来.
    //3.关闭数据库
    mysqli_close($link);
    //4.返回受影响的行数.
    return $rows;
}

//查
function excute_select($sql){
    //1.连接数据库
    $link = mysqli_connect('127.0.0.1','root','root','baixiu');
    //2.执行sql语句
    $res = mysqli_query($link,$sql); //返回的结果不是我们想要的.
    //3.处理结果
    $arr = mysqli_fetch_all($res,1);
    //4.关闭数据库
    mysqli_close($link);
    //5.返回查询后的结果
    return $arr;
}



?>