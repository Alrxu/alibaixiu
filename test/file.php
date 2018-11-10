<?php
// 接收到传递过来的图片
$icon=$_FILES['icon'];
// 取出这张图片的name
$name=$icon['name'];
//取出这张图片的临时路径
$temp_path=$icon['tmp_name'];

// 因为图片名是utf-8格式的,而当前服务器是中文Windows操作系统
//如果图片名是纯中文的会报错
//如果图片名中英混合,那么只会出现乱码,不会报错 
// 所以要转换图片名格式为gbk
$gbkName=iconv('utf-8','gbk',$name);
// 将图片存在本地
move_uploaded_file($temp_path,"../knowledge/$gbkName");
//  将路径返回
echo "../knowledge/$name";
?>