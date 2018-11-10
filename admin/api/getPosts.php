<?php
// 获取到传递过来的pageIndex和pageSize
$pageIndex = $_GET['pageIndex'];
$pageSize = $_GET['pageSize'];
// 还需要接收筛选的category 和status
$category = $_GET['category'];
$status = $_GET['status'];

// 查询数据库语句要有条件的添加,用拼接的方法
//连接数据库,查询所有已发布的文章数据
include_once "./../../phpTools.php";

$start = ($pageIndex - 1) * $pageSize;
$sql = "select p.id,p.title,u.nickname,c.name,p.created,p.status
        from posts p 
        inner join categories c 
        on p.category_id=c.id 
        inner join users u
        on p.user_id=u.id
        where p.status!='trashed'";
//  当分类不是所有分类时,要加语句
if ($category != '所有分类') {
    // 记得要前面要加空格
    $sql .= " and c.name='$category'";
}
// 当状态不是所有状态时,要加语句
if ($status != '所有状态') {
    $st=$status=='已发布'?'published':'drafted';
    $sql .= " and p.status='$st'";
}

// 将当前没有分页的语句存储起来,求总页数的时候用
$sql2 = $sql;

$sql .= "order by p.id desc
        limit $start,$pageSize";

$data = excute_select($sql);

//  totalPage

$pageCount = count(excute_select($sql2));
$totalPage = ceil($pageCount / $pageSize);

$arr = array(
    "data" => $data,
    "totalPage" => $totalPage
);
echo json_encode($arr);
?>