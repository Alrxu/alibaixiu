<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>阿里百秀-发现生活，发现美!</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.css">
</head>
<body>
  <div class="wrapper">
    <div class="topnav">
      <ul>
        <li><a href="javascript:;"><i class="fa fa-glass"></i>奇趣事</a></li>
        <li><a href="javascript:;"><i class="fa fa-phone"></i>潮科技</a></li>
        <li><a href="javascript:;"><i class="fa fa-fire"></i>会生活</a></li>
        <li><a href="javascript:;"><i class="fa fa-gift"></i>美奇迹</a></li>
      </ul>
    </div>
    <div class="header">
      <h1 class="logo"><a href="index.html"><img src="assets/img/logo.png" alt=""></a></h1>
      <ul class="nav">
      <?php 
      include_once"./phpTools.php";
            $sql = "select * from categories";
            $data = excute_select($sql);
            $arr = array('fa-glass', 'fa-phone', 'fa-fire', 'fa-gift');
            for ($i = 0; $i < count($data); $i++) :
            ?>
        <li><a href="list.php?name=<?php echo $data[$i]['name'] ?>&id=<?php echo $data[$i]['id'] ?>"><i class="fa <?php echo $arr[$i] ?>"></i><?php echo $data[$i]['name'] ?></a></li>
<?php endfor; ?>
      </ul>
      <div class="search">
        <form>
          <input type="text" class="keys" placeholder="输入关键字">
          <input type="submit" class="btn" value="搜索">
        </form>
      </div>
      <div class="slink">
        <a href="javascript:;">链接01</a> | <a href="javascript:;">链接02</a>
      </div>
    </div>
    <div class="aside">
      <div class="widgets">
        <h4>搜索</h4>
        <div class="body search">
          <form>
            <input type="text" class="keys" placeholder="输入关键字">
            <input type="submit" class="btn" value="搜索">
          </form>
        </div>
      </div>
      <div class="widgets">
        <h4>随机推荐</h4>
        <ul class="body random">
        <?php
             $sql="select title,views ,feature from posts where status='published' order by rand() limit 5 ";
             $data=excute_select($sql);
             for($i=0;$i<count($data);$i++):
            ?>
          <li>
            <a href="javascript:;">
              <p class="title"><?php echo $data[$i]['title']?></p>
              <p class="reading">阅读(<?php echo $data[$i]['views']?>)</p>
              <div class="pic">
                <img src="<?php echo $data[$i]['feature']?>" alt="">
              </div>
            </a>
          </li>
             <?php endfor;?>
        </ul>
      </div>
      <div class="widgets">
        <h4>最新评论</h4>
        <ul class="body discuz">
          <li>
            <a href="javascript:;">
              <div class="avatar">
                <img src="uploads/avatar_1.jpg" alt="">
              </div>
              <div class="txt">
                <p>
                  <span>鲜活</span>9个月前(08-14)说:
                </p>
                <p>挺会玩的</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <div class="avatar">
                <img src="uploads/avatar_1.jpg" alt="">
              </div>
              <div class="txt">
                <p>
                  <span>鲜活</span>9个月前(08-14)说:
                </p>
                <p>挺会玩的</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <div class="avatar">
                <img src="uploads/avatar_2.jpg" alt="">
              </div>
              <div class="txt">
                <p>
                  <span>鲜活</span>9个月前(08-14)说:
                </p>
                <p>挺会玩的</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <div class="avatar">
                <img src="uploads/avatar_1.jpg" alt="">
              </div>
              <div class="txt">
                <p>
                  <span>鲜活</span>9个月前(08-14)说:
                </p>
                <p>挺会玩的</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <div class="avatar">
                <img src="uploads/avatar_2.jpg" alt="">
              </div>
              <div class="txt">
                <p>
                  <span>鲜活</span>9个月前(08-14)说:
                </p>
                <p>挺会玩的</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <div class="avatar">
                <img src="uploads/avatar_1.jpg" alt="">
              </div>
              <div class="txt">
                <p>
                  <span>鲜活</span>9个月前(08-14)说:
                </p>
                <p>挺会玩的</p>
              </div>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="content">
        <?php
        $id=$_GET['id'];
         include_once"./phpTools.php";
         $sql="select p.id,c.name,p.title,u.nickname,p.views,p.created from posts p
                inner join users u
                on p.user_id=u.id
                inner join categories c
                on p.category_id=c.id
                where p.id=$id";
        $data=excute_select($sql);
        $sql2="select * from comments where post_id=$id";
        $count=count(excute_select($sql2));
       $data=$data[0];
         //阅读量   先拿到阅读量,在原来阅读量的基础上+1,再修改到数据库
       $viewCount=$data['views']+1;
       $sql3="update posts set views='$viewCount' where id=$id";
       excute_zsg($sql3);
        ?>
      <div class="article">
        <div class="breadcrumb">
          <dl>
            <dt>当前位置：</dt>
            <dd><a href="javascript:;"><?php echo $data['name']?></a></dd>
            <dd><?php echo $data['title']?></dd>
          </dl>
        </div>
        <h2 class="title">
          <a href="javascript:;"><?php echo $data['title']?></a>
        </h2>
        <div class="meta">
          <span><?php echo $data['nickname']?> 发布于 <?php echo $data['created']?></span>
          <span>分类: <a href="javascript:;"><?php echo $data['name']?></a></span>
          <span>阅读: (<?php echo $data['views']?>)</span>
          <span>评论: (<?php echo $count?>)</span>
        </div>
      </div>
      <div class="panel hots">
        <h3>热门推荐</h3>
        <ul>
        <?php
           include_once"./phpTools.php";
           $sql="select id,title,feature,likes from posts order by likes desc limit 4 ";
           $data=excute_select($sql);

         
           for($i=0;$i<count($data);$i++):
           ?> 
          <li>
            <a href="detail.php?id=<?php echo $data[$i]['id']?>">
              <img src="<?php echo $data[$i]['feature']?>" alt="">
              <span><?php echo $data[$i]['title']?></span>
            </a>
          </li>
        <?php endfor;?>
        </ul>
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
</body>
</html>
