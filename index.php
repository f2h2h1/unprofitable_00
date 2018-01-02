<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>一站二手图书交易站</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>

</head>

<body>

<nav class="navbar  " role="navigation" id="nav">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand " href="login.html">用户[<?php session_start();echo $_SESSION["email"] ?>]欢迎您!</a>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">主页</a></li>
                <li><a href="#"  v-on:click="getMyBooks">我的图书</a></li>
                <li class="active"><a href="newBook.php">发布图书</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        分类查找
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#" v-on:click="getBook('getBook','c')" >计算机类</a></li>
                        <li><a href="#" v-on:click="getBook('getBook','l')" >文学类</a></li>
                        <li><a href="#" v-on:click="getBook('getBook','e')"  >外语类</a></li>
                        <li><a href="#" v-on:click="getBook('getBook','j')" >经管类</a></li>
                        <li><a href="#" v-on:click="getBook('getBook','y')" >医学类</a></li>
                    </ul>
                </li>

                <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="search" class="form-control" placeholder="金瓶梅">
                    </div>
                    <button type="submit" class="btn btn-default"  v-on:click="searchBooks">搜索图书</button>
                </form>
            </ul>
        </div>
    </div>
</nav>

<!--------------------------------------------------------------------------------->

<div id="list">
    <template v-for="book in booksList">
        <div class="media">
            <a class="media-left" href="#">
                <img class="media-object "  style="width:142px; height:192px;" v-bind:src="book.sourcePath" alt="封面">
            </a>
            <div class="media-body">
                <h4 class="media-heading">{{book.title}}</h4>
                <p class="text-info">作者：{{book.author}}</p>
                <p class="text-danger" >可售：{{book.inStock}}</p>
                出版社：{{book.yearOfPublish}}--{{book.publisher}}
                ISBN：{{book.ISBN}}
                <h5 class="text-info">联系方式：{{book.phone}}</h5>
                <h4 class="text-right " style="color:red;">价格：{{book.price}}</h4>



            </div>
        </div>
    </template>
    <!--v-for-end-->
</div>


<!--v-for-start-->
<script src="https://cdn.bootcss.com/vue/2.5.13/vue.js"></script>
<script>
    function getMessage(ac,p) {
        console.log(2);
        $.post(
            "getMessage.php" ,
            "action="+ ac + "&what="+ p,
            function (d) {
                console.log(1);
                list.booksList = d;
            },"json");
    };

    $(function(){
        getMessage('getBooks');console.log(3);
    });
     list = new Vue({
        el: '#list',
        data: {
            booksList: [],
        },
        methods: {}
    })
     nav = new Vue({
        el: '#nav',
        data:{
        },
        methods:{
            getMyBooks: function(event) {
                getMessage('getMyBooks','he');
            },
            getBook: function(a,p) {
                getMessage(a,p);
            },

            searchBooks: function(event) {
                getMessage('searchBooks',$(".search").val());
            }
        }
    })


</script>

</body>
</html>