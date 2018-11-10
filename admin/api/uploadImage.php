<?php
    $icon=$_FILES['icon'];
    $name=$icon['name'];
    $temp_path=$icon['tmp_name'];
    $newname=iconv('utf-8','gbk',$name);
    $path="../../uploads/$newname";
    move_uploaded_file($temp_path,$path);
  echo "/uploads/$name";
?>