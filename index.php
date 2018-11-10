<?php
include_once "./phpTools.php";
$sql = "select * from options where id=10";
$data = excute_select($sql);

$data = $data[0]['value'];
// //转换成php数据
$phpdata = json_decode($data, true);
//  参数2:是否要转换为关联型数组
// var_dump($phpdata);

$sql2 = "select id,title,feature,views,likes from posts where status='published' order by views desc limit 5";

$data2 = excute_select($sql2);
// var_dump($data2);


?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>阿里百秀-发现生活，发现美!</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.css">
  <style>
  .swipe-wrapper li img {
      height:272px;
  }
  </style>
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
      <div class="swipe">
        <ul class="swipe-wrapper">
         <?php for ($i = 0; $i < count($phpdata); $i++) : ?>
          <li>
            <a href="<?php echo $phpdata[$i]['link'] ?>">
              <img src="<?php echo $phpdata[$i]['image'] ?>">
              <span><?php echo $phpdata[$i]['text'] ?></span>
            </a>
          </li>
<?php endfor; ?>
        </ul>
        <p class="cursor">
        <?php for ($i = 0; $i < count($phpdata); $i++) :
            $className = $i == 0 ? "active" : "";
        ?>
            <span class="$className"></span>
<?php endfor; ?>
        </p>
        <a href="javascript:;" class="arrow prev"><i class="fa fa-chevron-left"></i></a>
        <a href="javascript:;" class="arrow next"><i class="fa fa-chevron-right"></i></a>
      </div>
      <div class="panel focus">
        <h3>焦点关注</h3>
        <ul>
        <?php for ($i = 0; $i < count($data2); $i++) :
            $className = $i == 0 ? "large" : " ";
        ?>
          <li class="<?php echo $className ?>">
            <a href="detail.php?id=<?php echo $data2[$i]['id'] ?>">
              <img src="<?php echo $data2[$i]['feature'] ?>" alt="">
              <span><?php echo $data2[$i]['title'] ?></span>
            </a>
          </li>
        <?php endfor; ?>
        </ul>
      </div>
      <div class="panel top">
        <h3>一周热门排行</h3>
        <ol>
        <?php for ($i = 0; $i < count($data2); $i++) : ?>
          <li>
            <i><?php echo $i + 1; ?></i>
            <a href="detail.php?id=<?php echo $data2[$i]['id'] ?>"><?php echo $data2[$i]['title']; ?></a>
            <a href="javascript:;" class="like">赞(<?php echo $data2[$i]['likes']; ?>)</a>
            <span>阅读 (<?php echo $data2[$i]['views']; ?>)</span>
          </li>
        <?php endfor; ?>
        </ol>
      </div>
      <div class="panel hots">
        <h3>热门推荐</h3>
        <ul>
           <?php
            include_once "./phpTools.php";
            $sql = "select id,title,feature,likes from posts order by likes desc limit 4 ";
            $data = excute_select($sql);
            for ($i = 0; $i < count($data); $i++) :
            ?> 
          <li>
            <a href="detail.php?id=<?php echo $data[$i]['id'] ?>">
              <img src="<?php echo $data[$i]['feature'] ?>" alt="">
              <span><?php echo $data[$i]['title'] ?></span>
            </a>
          </li>
        <?php endfor; ?>
        </ul>
      </div>
      <div class="panel new">
        <h3>最新发布</h3>
        <?php
        $sql="select p.feature, p.title,u.nickname,p.created,p.content,p.views,p.likes,c.name from posts p
        inner join users u
        on p.user_id=u.id
        inner join categories c
        on p.category_id=c.id
        order by p.created desc
        limit 4";
        $data=excute_select($sql);
        for($i=0;$i<count($data);$i++):
        ?>
        <div class="entry">
          <div class="head">
            <span class="sort"><?php echo $data[$i]['name']?></span>
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
                分类：<span><?php echo $data[$i]['name']?></span>
              </a>
            </p>
            <a href="javascript:;" class="thumb">
              <img src="<?php echo $data[$i]['feature']?>" alt="">
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
  <script src="assets/vendors/jquery/jquery.js"></script>
  <script src="assets/vendors/swipe/swipe.js"></script>
  <script>
    //
    var swiper = Swipe(document.querySelector('.swipe'), {
      auto: 3000,
      transitionEnd: function (index) {
        // index++;

        $('.cursor span').eq(index).addClass('active').siblings('.active').removeClass('active');
      }
    });

    // 上/下一张
    $('.swipe .arrow').on('click', function () {
      var _this = $(this);

      if(_this.is('.prev')) {
        swiper.prev();
      } else if(_this.is('.next')) {
        swiper.next();
      }
    })
  </script>
</body>
</html>
