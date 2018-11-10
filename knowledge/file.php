<?php 

    $icon = $_FILES['icon'];

    $name = $icon['name'];

    $tmp = $icon['tmp_name'];

    //现象：如果是纯中文的文件名，那么报错
    //如果是中英文混合，只是中文部分乱码
    //反正包含中文肯定有问题
    //原因？因为网页上传的时候用的UTF-8，所以图片名是UTF-8编码的，上传到我们当前的服务器，而我们当前服务器是中文windows操作系统
    //中文windows操作系统默认使用的编码是GBK,所以编码不符，就会乱码
    //解决办法：把名字转为GBK的名字

    $gbkName = iconv('utf-8','gbk',$name);

    move_uploaded_file($tmp,"upload/$gbkName");

    //要返回路径！！！
    echo "upload/$name";
?>