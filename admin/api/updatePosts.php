<?php
//获取到传递过来的数据
$postId = $_POST['postId'];
$slug = $_POST['slug'];
$title = $_POST['title'];
$feature = $_FILES['feature'];
$created = $_POST['created'];
$status = $_POST['status'];
$category_id = $_POST['category'];

// 获取到新增文章的用户名 user_id
session_start();
$userid = $_SESSION['info']['id'];

//获取到新增的内容
$content = $_POST['content'];

// 获取到图片名
$name = $feature['name'];
//获取到图片的临时路径
$temp_path = $feature['tmp_name'];
// 由于图片名是utf-8的格式,而当前服务器是中文windows操作系统,所以要将图片名转换为gbk格式
$newname = iconv('utf-8', 'gbk', $name);
// 将图片保存到本地,目标路径,php不支持根目录
$path = "../../uploads/$newname";
//移动图片
move_uploaded_file($temp_path, $path);

// 因为最后图片路径要上传到数据库,数据库是utf-8格式
// 图片路径要改为utf-8的格式上传到数据库
$path = "../../uploads/$name";

// 数据库新增操作
include_once "./../../phpTools.php";
// 要进行判断,如果图片没有修改,就不用修改图片
if ($name != "") {
    $sql = "update posts set
    slug='$slug',
    title='$title',
    feature='$path',
    created='$created',
    status='$status',
    category_id='$category_id',
    content='$content'
    where id='$postId'";
                 
} else {
    $sql = "update posts set
     slug='$slug',
     title='$title',
     created='$created',
     status='$status',
     categort_id='$category_id',
     content='$content'
     where id='$postId'";
}

$rows = excute_zsg($sql);

if ($rows) {
    echo "ok";
} else {
    echo "fail";
}


?>