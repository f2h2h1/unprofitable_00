<?php
/*
http://cdn.duitang.com/uploads/people/201601/28/20160128091428_HhGmE.jpeg
http://i4.buimg.com/501024/977d0b950d6e899d.jpg

http://i2.buimg.com/501024/9bef609a6c4a1319.png
*/
?>
<?php
function curl_get($url)
{
    
    $refer = "http://music.163.com/";
    $header[] = "Cookie: " . "appver=1.5.0.75771;";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
    curl_setopt($ch, CURLOPT_REFERER, $refer);
    $output = curl_exec($ch);
    curl_close($ch);
    
    return $output;
}


function get_music_info($music_id)
{
    $url = "http://music.163.com/api/song/detail/?id=" . $music_id . "&ids=%5B" . $music_id . "%5D";
    
    return curl_get($url);
}

$play_info=json_decode(get_music_info("209643"), true);

?>
<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=device-dpi">
        <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
        <!-- 新 Bootstrap 核心 CSS 文件 -->
        <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <!-- 可选的Bootstrap主题文件（一般不用引入） -->
        <!-- <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">-->
        
        <link href="style.css" rel="stylesheet">
        <link href="//cdn.bootcss.com/animate.css/3.5.2/animate.min.css" rel="stylesheet">
        <script src="http://7xopbl.com1.z0.glb.clouddn.com/jscys.js"></script>
        <title>给新生军训捐太阳</title>
    </head>
    <body>

            
        <div class="well" style="margin-bottom: 0px;">
            <div class=" text-center">
                <h2>预祝2016级新生军训</h2>
                <h4>风和日丽、万里无云、烈日炎炎</h4>
                <h4>骄阳似火、汗流浃背、挥汗如雨</h4>
                <h4>皎阳似火、赤日炎炎、火伞高张</h4>
                <h4>在烈日下得到强力的锻炼！为将来成为师兄师姐一样的人才而奋斗</h4>
                <h4>为师弟师妹们能得到更好的锻炼，在此，贡献太阳</h4>
                <h4>戳加号增加太阳数，当然戳减号减少</h4>
                <!--
<h4>风和日丽、万里无云、碧空如洗</h4>风和日丽、万里无云、烈日炎炎
<h4>天高云淡、烈日炎炎、骄阳似火</h4>骄阳似火、汗流浃背、挥汗如雨
<h4>汗流浃背、挥汗如雨、夏日炎炎</h4>皎阳似火、赤日炎炎、火伞高张 
<h4>夏日可畏、皎阳似火、赤日炎炎</h4> 
<h4>火伞高张、流金铄石、汗如雨下</h4> 
-->
            </div>
            <div style="right:80px; top:280px;opacity:1;position:absolute;z-index:99" onclick="music_button()">
                <audio id="music" src="<?php echo $play_info['songs']['0']['mp3Url'];?>" preload="auto" autoplay="autoplay" loop="loop"></audio> 
                
            </div>
            <div class="form-group">
                <div class="control-group">
                    <div class="col-xs-2">
                        <ul class="pull-right">
                            <li class="pull-right"><h4 id="minus_number"  style="color:#f5f5f5;">- <span id="minus_number_span">1</span></h4></li>
                            <li class="pull-right"><button type="button" id="minus_buttom" class="btn btn-default pull-right" style="height:150px"><span class=" glyphicon glyphicon-minus"></span></button></li>
                        </ul>
                    </div>
                    <div class="col-xs-8">
                        <div id="sun" style="background: url('http://i2.buimg.com/501024/9bef609a6c4a1319.png') no-repeat;background-size: 100%;text-align: center;margin:0 auto;">
                            <h4 style="padding-top:32%">阳光指数</h4>
                            <h4 id="sunshine_index">100</h4>
                        </div>
                        <!--<img id="sun" class="img-responsive" style="margin:0 auto;" src="http://i4.buimg.com/501024/977d0b950d6e899d.jpg"/>-->
                        
                    </div>
                    <div class="col-xs-2">
                        <ul class="pull-left">
                            <li class="pull-left"><h4 id="add_number"  style="color:#f5f5f5">+ <span id="add_number_span">1</span></h4></li>
                            <li class="pull-left"><button type="button" id="add_buttom" class="btn btn-default pull-left" style="height:150px"><span class=" glyphicon glyphicon-plus"></span></button></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="control-group">
                    <div class="controls">
                        <button class="btn btn-large btn-block btn-warning" type="button" onclick="shareWeixin('1')">让太阳来得更猛烈些吧</button>
                    </div>
                </div>
            </div>
            
            
            <footer>
                <div class="container">
                    <p class="text-center">&copy; 秒嗨团队出品</p>
                </div>
            </footer>
            
        </div>
        <div id="shareBoxBg" onclick="shareWeixin('0')">  
            <div id="shareBox"style="margin-top: 20px; padding-left:30px;line-height:1.7">
                <img width="100%"src="http://i1.piimg.com/501024/5a1b719fed3ba2f2.png" />
                戳右上角号召朋友圈更多人捐太阳吧！祖国花朵的成长需要我们的一份力！
            </div>
        </div>
        <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
        <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
        <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
        <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="demojs.js"></script>
        <script type="text/javascript" src="http://tajs.qq.com/stats?sId=58485022" charset="UTF-8"></script>
    </body>
</html>