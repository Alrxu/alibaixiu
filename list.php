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
        include_once "./phpTools.php";
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
          <li>
            <a href="javascript:;">
              <p class="title">废灯泡的14种玩法 妹子见了都会心动</p>
              <p class="reading">阅读(819)</p>
              <div class="pic">
                <img src="uploads/widget_1.jpg" alt="">
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <p class="title">可爱卡通造型 iPhone 6防水手机套</p>
              <p class="reading">阅读(819)</p>
              <div class="pic">
                <img src="uploads/widget_2.jpg" alt="">
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <p class="title">变废为宝！将手机旧电池变为充电宝的Better</p>
              <p class="reading">阅读(819)</p>
              <div class="pic">
                <img src="uploads/widget_3.jpg" alt="">
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <p class="title">老外偷拍桂林芦笛岩洞 美如“地下彩虹”</p>
              <p class="reading">阅读(819)</p>
              <div class="pic">
                <img src="uploads/widget_4.jpg" alt="">
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <p class="title">doge神烦狗打底南瓜裤 就是如此魔性</p>
              <p class="reading">阅读(819)</p>
              <div class="pic">
                <img src="uploads/widget_5.jpg" alt="">
              </div>
            </a>
          </li>
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
      <div class="panel new">
      <?php
            $name = $_GET['name'];
            $id = $_GET['id'];
            $sql="select p.title,u.nickname,p.created,p.content,p.views,p.likes,c.name from posts p
            inner join users u
            on p.user_id=u.id
            inner join categories c
            on p.category_id=c.id
            where p.category_id=$id limit 3";
            $data=excute_select($sql);
            for($i=0;$i<count($data);$i++):
            ?>
        <h3><?php echo $name ?></h3>
        
        <div class="entry">
          <div class="head">
            <a href="javascript:;"><?php echo $data[$i]['title']?></a>
          </div>
          <div class="main">
            <p class="info"><?php echo $data[$i]['nickname']?> 发表于 <?php echo $data[$i]['created']?></p>
            <p class="brief"><?php echo $data[$i]['content']?></p>
            <p class="extra">
              <span class="reading">阅读(<?php echo $data[$i]['views']?>)</span>
              <span class="comment">评论(0)</span>
              <a href="javascript:;" class="like">
                <i class="fa fa-thumbs-up"></i>
                <span>赞(<?php echo $data[$i]['likes']?>)</span>
              </a>
              <a href="javascript:;" class="tags">
                分类：<span><?php echo $name?></span>
              </a>
            </p>
            <a href="javascript:;" class="thumb">
              <img src="uploads/hots_2.jpg" alt="">
            </a>
          </div>
        </div>
            <?php endfor;?>
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
</body>
</html>
