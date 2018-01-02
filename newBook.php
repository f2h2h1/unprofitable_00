<html>
<head>
<meta charset="UTF-8">
<title>一站二手图书交易站</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
</head>
<hr>
<style>
    .new {
        text-align:center
    }
</style>

<form class="form-inline new" role="form" method="post" action="Add.php" enctype="multipart/form-data">
    <h3>请输入要上传的图书信息</h3>
    <div class="form-group form-horizontal">
        <label for="bookname" class=" control-labe">书名:</label>
                   <input type="text" name="bookname" class="form-control"  placeholder="书名">
          </div>

    <br>
    <br>

    <div class="form-group">
        <label for="price" class=" control-label">价格:</label>
            <input type="text" name="price" class="form-control"  placeholder="">
    </div>
    <br>
    <br>

    <div class="form-group">
        <label for="count" class=" control-label">发布数量:</label>
        <input type="text" name="count" class="form-control"  placeholder="1">
    </div>
    <br>
    <br>

    <div class="form-group">
        <label for="author"  class=" control-label">作者:</label>
        <input type="text" name="author" class="form-control"  placeholder="">
    </div>
    <br><br>

    <div class="form-group">
        <label for="publisher" class=" control-label">出版社:</label>
        <input type="text" name="publisher" class="form-control" placeholder="">
    </div>
    <br><br>

    <div class="form-group">
        <label for="year" class=" control-label">出版年份:</label>
        <input type="text" name="year" class="form-control"  placeholder="">
    </div>
    <br><br>

    <div class="form-group">
        <label for="ISBN" class=" control-label">ISBN:</label>
        <input type="text" name="ISBN" class="form-control"  placeholder="">
    </div>
    <br><br>

    <div class="form-group form-inline">
        <input type="file" name="file" id="file" required placeholder="封面图片">

    </div>

    <br><br>
    <div class="form-group form-inline">
        <label for="tag" class=" control-label">选择图书种类:</label>
        <select name="tag">
            <option value="c">计算机类</option>
            <option value="l">文学类</option>
            <option value="e">外语类</option>
            <option value="j">经管类</option>
            <option value="y">医学类</option>
        </select>

    </div>
    <br>
    <br>
    <br>
    <button type="submit" class="btn btn-default">#确认添加图书#</button>

</form>
</html>


