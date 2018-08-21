---
title: 实现功能步骤分析-04
typora-copy-images-to: media
---
##    /***************** 添加文章功能**************************
     
###  一.初始化添加文章的页面post-add.html

-      (1).显示富文本编辑器
        使用富文本编辑器插件
        ① 将textarea标签删除,写一个div#content
        ② 导入插件wangEditor.js
        ③ 将div变成富文本编辑器:
          1.创建富文本对象
          var editor=new WangEditor('#content');
          2. 调用create方法
          editor.create();

      (2).显示图片预览
        将图片转换成临时url,把url给img的srcvar url=URL.createObjectURL();
        ① 给选择文件一个值改变事件:对于上传文件而言,选择不同的文件触发的事件
        onchange{
        ② 将上传的图片转换为url,然后把url给img的src
         var url=URL.createObjectURL(this.files[0])  
         document.getElementById('icon').src=url;
            //file元素有files属性,files是一个数组,保存着上传的全部文件
            //而默认只能上传一张图片,所以直接取下标为0,就是刚选择的图片
            //this.files[0]就是刚选择的图片
       }

      (3).显示当前日期时间
        使用moment.js插件
        var date=moment().format('YYYY-MM-DDTHH-mm');
        moment()括号里面如果写了时间就是固定不变的
        如果没有写时间,那么就是按照当前时间,随着时间改变

      (4).显示分类
         一打开页面,当页面的全部样式都显示出来之后发送请求到getCategory.php(与posts页面显示分页的接口一样)
         浏览器端addPosts.html接收到响应体,遍历响应体,每循环一次生成一个option,并赋值

###   二.实现点击保存添加文章

-      (1) 点击保存按钮
          ① 阻止保存按钮默认跳转 e.preventDefault()
          ② 发送请求之前先把要传递的参数准备好
            传递的参数是对象: 使用FormData对象,FormData能获取表单中所有有name属性的表单元素的值
            a. 创建FormData对象 var fm=new FormData(document.querySelector('form'));
            b. 由于要上传富文本编辑器中的内容,而FormData只能获取表单元素,手动将编辑内容添加到FormData
               fm.append(editor.txt.html())
               // editor.txt.html()能获取到富文本编辑器中的文本包括标签
               //editor.txt.text()只能获取纯文本
          ③ jQuery发送请求:
            注意:
              a.请求对象是fm
              b.jQuery发送请求,会自动将传递的参数解析成字符串,而FormData不用解析字符串
                解决: 让jQuery不要将参数解析成字符串--添加contentType:false,
              c.jQuery发送post请求,本身设置了请求头,而FormData内部也设置了请求头,会冲突
                解决: 让jQuery不要设置请求头--添加processData:false,
      (2) 服务器接收FormData传递过来的数据
          注意:传递过去的图片要进行处理
            a.取出图片名utf-8格式   $name=$icon['name']
            b.取出图片的临时路径     $temp_path=$icon['tmp_name]
            c.将图片名转换为gbk格式
              因为图片名是utf-8格式,而当前服务器是中文windows操作系统,所以要转换为gbk格式
              $newname=iconv('utf-8','gbk',$name)
            d.要将图片保存到本地,目标路径
              $path="upload/$newname";
            e.移动图片 move_upload_file(临时路径,目标路径)
            f.图片需要上传到数据库,而数据库是utf-8格式,所以上传的图片路径要是utf-8格式
              $path="upload/$name"
            连接数据库增加操作 insert into  如果增加成功返回ok,否则返回fail
      (3) 浏览器接收响应体,如果响应体是ok,跳转到posts.html页面;否则alert新增失败


##      /------------------- posts.html页面编辑功能-----------------
       
###      一. 点击每行后面的编辑按钮跳转到编辑页面post-edit.html
-          在生成文章数据的模板里,编辑按钮连接编辑页面,后面要带上参数(要编辑的该行的id)
           post-edit.html?id={{value.id}}
###      二. 初始化编辑页面post-edit.html
-          编辑页面的初始化页面与添加文章页面一样
          注意:编辑页面要将显示当前时间删掉(因为要显示要编辑的该行的数据,不能显示当前的时间,而是要显示添加文章时的时间)
###      三.实现将需要编辑的那一篇文章的原数据显示在编辑页面上
-         (1) 一进入编辑页面,当页面的全部样式都显示之后发送请求
             发送请求,请求参数是要编辑的该行的id
               参数: 因为通过url拼接的id,需要从地址栏上取出id值
                location.search  获取到的是地址栏上的地址?以及?后面的内容 
                 例如: posts-edit.html?id=1001 使用location.search 获取到  ?id=1001
                要截取到1001  
                postId=location.search.substr(4)从下标为4开始截取
                所以参数id: postId  
         (2) 服务器接收到传递过来id,查询数据库,返回该篇文章的数据信息
         (3) 浏览器接收到响应体,将响应体中对应的内容显示到页面上
            注意:① 图片的 feature应该给img的src
                 ② 文章内容要给富文本编辑器,用editor.txt.html(文章内容)
###      四. 实现编辑之后点击保存,修改后的数据保存
-         (1) 点击保存按钮
           ① 阻止保存按钮默认跳转 e.preventDefault()
           ② 发送请求之前先把要传递的参数准备好
            传递的参数是对象: 使用FormData对象,FormData能获取表单中所有有name属性的表单元素的值
            a. 创建FormData对象 var fm=new FormData(document.querySelector('form'));
            b. 由于要上传富文本编辑器中的内容,而FormData只能获取表单元素,手动将编辑内容添加到FormData
               fm.append('content',editor.txt.html())
            c. 要将获取到的要编辑的该行的id上传,手动将id添加到FormData对象中
               fm.append('postId',postId)
          ③ jQuery发送请求:
            注意:
              a.请求对象是fm
              b.jQuery发送请求,会自动将传递的参数解析成字符串,而FormData不用解析字符串
                解决: 让jQuery不要将参数解析成字符串--添加contentType:false,
              c.jQuery发送post请求,本身设置了请求头,而FormData内部也设置了请求头,会冲突
                解决: 让jQuery不要设置请求头--添加processData:false,
          (2) 服务器接收到传递过去的数据,同样图片要做处理
              连接数据库,修改数据库操作 update..set...where id='$postId'
              成功,返回ok;否则,返回fail
          (3) 浏览器接收到响应体,如果是ok,跳转到posts.html文章页面;否则保存失败
        

##    /**********个人信息页面显示个人信息功能*********

###       一. 一打开页面,当页面全部样式显示出来之后,发送请求给getUserInfo.php(之前的用户信息)
###       二. 接收到响应体,将响应体中的相应内容显示到页面上
###       三.做图片预览,因为此时图片没有预览,显示不出来
-          值改变事件onchange
          ① 将刚选择的图片转为url
           var url=URL.createObjectURL(this.files[0]) 
          ② 把url给img的src 
           $('#icon').attr('src',url)

##    /**********修改个人信息功能********
###       一.点击更新按钮,
-         这里的参数用FormData对象获取,都是表单元素,不用额外手动添加
         发送请求和编辑文章的发送请求类似
###       二. 服务器接收到请求,获取到传递过来的数据
-          注意:图片要做处理
          数据库修改操作:
            要进行判断: 
            如果图片名$name不为空就表示修改了头像,SQL语句要加上修改图片的
            否则,就是没有修改头像,SQL语句就不需要加上修改图片的
          如果成功,返回ok,否则返回fail
###       三. 浏览器接收到响应体,如果是ok,就重新加载当前页面 location.reload();否则,更新失败
###       四. 解决问题:
-           做到这一步,有一个问题,个人信息修改在数据库修改成功,但是页面上仍显示原来的信息
           原因: 之前保存登录用户信息的session没有修改
           解决: 在服务器修改成功之后要修改session,例如:$_SESSION['info']['nickname']=$nickname
               注意: 修改session也要进行判断
                  如果没有修改头像,session中图片信息不用修改;否则要修改
                  if($name!=""){
                     要修改session中图片信息
                  }else{
                    不用修改session中的图片信息
                  }

   