            setInterval(now,2000);
            $(document).ready(function(){
                
                
                
                //alert($("#sun").attr("top"));
                //alert($("#sun").attr("width"));
                
                var height = window.innerHeight; 
                //var width = window.innerWidth; 
                
                var height1 = height*0.5;
                //var width1 = width*0.6;
                
                $("#sun").css("height", height1);
                $("#sun").css("width", $("#sun").parent().width());
                
                //alert($("#sun").parent().width());
                
                now(); 
                
                //shunshine_index.text(data);

                
                $("#minus_buttom").click(function(){
                    
                    $('#minus_buttom').attr("disabled", "disabled"); 
                    $('#add_buttom').attr("disabled", "disabled");
                    
                    var minus_number = $("#minus_number");
                    var shunshine_index = $("#sunshine_index");
                    
                    var number = Number(shunshine_index.text());
                    
                    var num = Math.random();//Math.random()：得到一个0到1之间的随机数
                    num = Math.ceil(num * 80);//num*80的取值范围在0~80之间,使用向上取整就可以得到一个1~80的随机数
                    
                    $("#minus_number_span").text(num);
                    
                    shunshine_index.text(number-num);
                    
                    ajax(num, "minus");

                    
                    animated(minus_number);
                    
                    
                });
                $("#add_buttom").click(function(){
                    
                    $('#minus_buttom').attr("disabled", "disabled"); 
                    $('#add_buttom').attr("disabled", "disabled");
                    
                    var add_number = $("#add_number");
                    var shunshine_index = $("#sunshine_index");
                    var number = Number(shunshine_index.text());
                    
                    var num = Math.random();//Math.random()：得到一个0到1之间的随机数
                    num = Math.ceil(num * 80);//num*80的取值范围在0~80之间,使用向上取整就可以得到一个1~80的随机数
                    $("#add_number_span").text(num);
                    
                    shunshine_index.text(number+num);
                    
                    ajax(num, "add");

                    animated(add_number);
                });
            });
            
            
            function now() {
                
                ajax(0, "now");

            }
            
            function animated(obj) {
                obj.css("color","black");
                obj.addClass('animated bounce');
                setTimeout(function(){
                    obj.removeClass('bounce');
                    obj.css("color","#f5f5f5");
                    $('#minus_buttom').removeAttr("disabled"); 
                    $('#add_buttom').removeAttr("disabled"); 
                }, 1000);
            }
            
            function ajax(num, status) {
                var shunshine_index = $("#sunshine_index");
                var url = "ajax_"+status+".php";
                var data;
                data = "number="+num+"&status="+status;
                url = url+"?"+data;
                $.get(url, function(data,status){
                    //alert("数据: " + data + "\n状态: " + status);
                    shunshine_index.text(data);
                });
                /*
                $.post(url,{
                    number:num,
                    status:status
                },function(data,status){
                    //alert("数据: \n" + data );
                    shunshine_index.text(data);
                });
                */
            }
            
            
            function shareWeixin(flg){
                
                var shareboxBg = document.getElementById("shareBoxBg");
                var sharebox = document.getElementById("shareBox");
                
                if(flg==1){
                    
                    sharebox.style.display="block";
                    shareboxBg.style.display="block";
                    $('html,body').animate({scrollTop:$('#shareBoxBg').offset().top}, 100);
                }else{
                    
                    sharebox.style.display="none";
                    shareboxBg.style.display="none";
                }
                
            }
