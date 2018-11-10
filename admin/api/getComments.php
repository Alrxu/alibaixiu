<?php

// 获取到提交过来的页码和每一页的容量
$pageIndex=$_GET['pageIndex'];
$pageSize=$_GET['pageSize'];
// 开始的条数=(页码-1)*每页容量
$start=($pageIndex-1)*$pageSize;
include_once"./../../phpTools.php";
$sql1="select c.id,c.author,c.content,p.title,c.created,c.status 
from comments c 
inner join posts p 
on c.post_id=p.id 
where c.status!='trashed' 
order by c.id asc 
limit $start,$pageSize;";
$data=excute_select($sql1);
// var_dump ($data);

// 查询评论总数
include_once"./../../phpTools.php";
$sql2="select * from comments where status!='trashed'";
$pageAll=count(excute_select($sql2));
// echo $pageAll;
//页码数:一共多少页
$pageNum=ceil($pageAll/$pageSize);
//将每页数据和页码总数返回
$arr=[
    "data"=>$data,
    "pageNum"=>$pageNum,
];
echo json_encode($arr) ;

?>