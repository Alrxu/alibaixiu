---
title: 实现功能步骤分析-01
typora-copy-images-to: media
---

    
##     (1) 让用户名或密码错误的提示隐藏
##     (2) 让登录的a标签在没有判断的情况下点击不会跳转
##     (3) 实现:

###     一. 实现点击登录,进入index页面,且没有登录直接用网址则不能进入
-            ① login.html页面点击登录发送请求到服务器
            ② doLogin.php服务器获取提交的邮箱和密码,连接数据库进行判断,如果邮箱密码正确返回ok并且将这条登信息用session保存,否则返回fail
            ③ login.html浏览器端接收到响应体后,如果接收到的响应体是ok(邮箱和密码都正确),进入index页面;否则错误提示信息显示出来
            ④ 在index.html页面还没有加载出来之前,发送同步请求
                checkIsLogin.php服务器接收请求,判断是否有session保存的登录信息存在,有则返回ok,否则返回fail
                index.html接收到响应体,如果响应体不是ok,就返回login.html登录页面
###     二. 实现index.html页面点击退出,会退出登录
-            ① 退出的a标签的href属性连接doLogOut.php页面
            ② doLogOut.php服务器接收请求,删除保存有登录信息的session,之后跳转回login.html登录页面
        
###     三. 实现进入index.html页面之后显示登录用户的用户名和头像
-            ① 在index.html页面全部样式都加载出来后,发送请求
            ② getUserInfo.php服务器接收请求,从保存登录信息的session中获取登录信息,并转换为json数据
            ③ index.html接收响应体,将响应体中的用户名和信息更新到对应的地方
            ④ 注意: 在index.html页面中由于手风琴样式的侧边栏中每点击一栏,一直都显示登录用户名和头像
                    所以，并不只index.html页面需要发送该请求,而是里面的每个子页面都需要发送请求
                    解决方法: 将发送请求和接收响应的操作放在每个子页面都导入了的jQuery.js里面的最底下
###     四. 实现显示站点内容统计(文章篇数,分类数,评论条数)
-            ① 在index.html页面全部样式都加载出来后,发送请求
            ② getWebInfo.php接收请求,连接数据库查询,将查询得到的文章总篇数,草稿数,分类数,评论条数,待审核放在关联数组里面
              将关联数组转换为json字符串返回
            ③ index.html页面接收响应体,将响应体中的各数据更新到对应地方





  
