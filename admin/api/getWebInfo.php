<?php
//查询数据库
include_once "./../../phpTools.php";
$sql1 = "select * from posts where status='drafted' or status='published'";
$postsCount = count(excute_select($sql1));
$sql2 = "select * from posts where status='drafted'";
$draftedCount = count(excute_select($sql2));
$sql3 = "select * from categories";
$categoryCount = count(excute_select($sql3));
$sql4 = "select * from comments where status!='trashed'";
$commentsCount = count(excute_select($sql4));
$sql5 = "select * from comments where status='held'";
$heldCount = count(excute_select($sql5));

$arr = [
    "postsCount" => $postsCount,
    "draftedCount" => $draftedCount,
    "categoryCount" => $categoryCount,
    "commentsCount" => $commentsCount,
    "heldCount" => $heldCount
];
echo json_encode($arr);
?>