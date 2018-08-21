---
title: 实现功能步骤分析-03
typora-copy-images-to: media
---

##    一. 问题:comments页面批量删除操作,当批量删除最后一整页的评论之后,
-        由于之前写的批量操作成功之后,刷新当前页面,而最后一页已经删除,刷新当前页就没有数据
        解决:在批量操作成功之后判断
            (1) 是批量删除操作(即status为trashed)
            (2) 而且是删除一整页的评论(即thead的选框选中就是批量操作全部评论)
            (3) 而且是最后一页(即总页),
             拿到总页:在loadData前面定义一个全局变量gloabTotalPage,在loadData中接收到响应体之后用该全局变量存储响应体中的totalPage
         符合上面三个条件的(即使批量删除最后一页的全部评论),那么就调用loadData(gloabTotalPage-1))刷新前一页即可
    
##    二. 实现文章页面(posts.html)文章数据显示
-       (1) 一打开页面,在页面的全部样式加载完之后发送请求,参数页码pageIndex和页容量pageSize
        (2) 服务器端接收到请求,获取传递过来的pageIndex和pageSize,
           需要返回分页的数据data(需要进行分页查询)和总页数totalPage(查询文章数)
           ① 分页查询,文章数据显示的内容连三张表(categories表,users表,posts表)查询
                limit 从第几条开始,页容量
               从第几条开始查询=(页码-1)*页容量
           ②文章数查询 总页数=向上取整(文章数/页容量)
        (3) 浏览器端接收到响应体,用响应体.data填充模板

##    三. 实现点击页码分页显示文章数据(使用jQuery插件)
-        在loadData中接收响应成功之后,使用分页插件
        $('#pagination-demo').twbsPagination({
        totalPages: 35,(总页数)
        visiblePages: 7,(显示几个页码)
        //onPageClick是每个页码的点击事件,这个事件默认第一次生成页码的时候会调用一次,
        //不必要,所以加上禁止 初始化插件时自动调用一次点击事件 的属性
        initiateStartPageClick:false	
        //
        onPageClick: function (event, page) {
            //点击页码的操作
        }
    });

##    四. 实现分类下拉框category动态生成各分类
-       (1) 一打开页面,当页面的全部样式都显示出来后,发送请求
        (2) 服务器接收请求,查询分类表(categories),返回查询到的表的内容
        (3) 浏览器端接收到响应体,for遍历响应体,createElement动态生成option,并将响应体.name赋值给新生成的option

##    五.实现筛选显示文章数据
-        与显示文章数据使用同一个请求loadData和接口getPosts.php
        由于要根据筛选的条件显示文章数据,就需要拿到筛选的条件(两个select下拉框中被选中的值)
        (1) 拿到两个下拉框被选中的值,
            注意: select有一个特殊的属性value, 
                  如果option有value属性,select的value值就是当前被选中的option的value属性值
                  如果option没有value属性,那么select的value值就是当前被选中的option的值(即被选中的筛选条件)
            所以如果option中有value属性一定要删除,这样select的value拿到的才是筛选条件
        (2) loadData发送请求需要添加发送的参数:文章分类category和文章状态status
            category:$(分类下拉框的select).val(),
            status:$(状态下拉框的select).val()
        (3) 给筛选按钮一个点击事件:
                注意: 那是一个form表单,按钮是button,给button点击事件是,要阻止事件默认行为  e.preDefault()
                点击按钮,调用loadData事件 loadData(1) 默认刷新第一页  筛选默认显示第一页,如果要显示其他页,点击页码后相当于刷新了
        (4) loadData发送请求,服务器接收请求, getPosts.php接口也要修改
            ① 添加:获取传递过来的category和status
            ② 分页查询SQL语句也要修改,因为要有条件的添加筛选条件,将SQL语句用拼接的方式
               1. $sql="三表连表查询,不包含limit分页语句";
                 因为默认显示的文章数据是'所有分类'和'所有状态',所以只有当筛选条件不是'所有分类'和'所有状态'时,才要添加SQL语句
               2. ① 如果分类$category!='所有分类',
                    SQL语句拼接 $sql.=" and c.name='$categroy'";

                    由于状态传过来的是中文,而数据库中状态时英文,所以需要处理
                  ② $st=$status=='已发布'?'published':'drafted';
                    如果状态$status!='所有状态',SQL语句拼接 $sql.=" and p.status='$st'";
                  ③ 要将到这个步骤的sql存储起来$sql2=$sql,求总页数的需要用 
                  ④ 查询分页的SQL语句最终还要要加上limit---->$sql.='limit....';
               3. 查询全部文章的sql语句也要修改,改为$sql2
    
##    六.解决问题:
-        按理筛选之后的总页数会改变,然而此时,筛选的页面与所有分类并且所有状态下的总页数一样
    ----原因: 
          分页插件出于节省效率,只有第一次调用的时候才会初始化,后面几次调用这个代码都不会初始化
    ----解决: 让它每次调用都是第一次
           即在使用分页插件代码的前面添加一行销毁分页
           ① $('分页的ul').twbsPagination('destroy');
            注意:加了①之后,此时每次调用都是第一次,每次点击页码显示数据但是页码高亮始终是页码为1
               因为插件默认起始页就是1
               而为什么之前没有加销毁分页代码时不会出现这个问题?
              --因为之前禁止了 初始化插件时自动调用一次点击事件,之后点击页码时,不会再初始化了(即默认起始页为1没有效果了)
              --而现在是每次点击都是第一次,都要初始化一次,所以每次初始化都会有默认起始页为1的效果
            所以还要设置默认起始页为当前页
            ② startPage:page,
                  
    注意:
         
       注意:....prop('checked',数据)  填的数据不用加引号
      
          

 