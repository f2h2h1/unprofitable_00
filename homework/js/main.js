    function correctPNG() // correctly handle PNG transparency in Win IE 5.5 & 6. 
    { 
        //alert(window.top.document.compatMode) ;
        var arVersion = navigator.appVersion.split("MSIE") 
        var version = parseFloat(arVersion[1]) 
        if ((version >= 5.5) && (document.body.filters)) 
        { 
            for(var j=0; j<document.images.length; j++) 
            { 
                var img = document.images[j] 
                var imgName = img.src.toUpperCase() 
                if (imgName.substring(imgName.length-3, imgName.length) == "PNG") 
                { 
                    var imgID = (img.id) ? "id='" + img.id + "' " : "" 
                    var imgClass = (img.className) ? "class='" + img.className + "' " : "" 
                    var imgTitle = (img.title) ? "title='" + img.title + "' " : "title='" + img.alt + "' " 
                    var imgStyle = "display:inline-block;" + img.style.cssText 
                    if (img.align == "left") imgStyle = "float:left;" + imgStyle 
                    if (img.align == "right") imgStyle = "float:right;" + imgStyle 
                    if (img.parentElement.href) imgStyle = "cursor:hand;" + imgStyle 
                    var strNewHTML = "<span " + imgID + imgClass + imgTitle 
                    + " style=\"" + "width:" + img.width + "px; height:" + img.height + "px;" + imgStyle + ";" 
                    + "filter:progid:DXImageTransform.Microsoft.AlphaImageLoader" 
                    + "(src=\'" + img.src + "\', sizingMethod='scale');\"></span>" 
                    img.outerHTML = strNewHTML 
                    j = j-1 
                } 
            } 
        }     
    } 
    window.attachEvent("onload", correctPNG);
    function ChangeTabbedPanels(x) 
    {
        
        var TabbedPanelsContent1=document.getElementById("TabbedPanelsContent1");
        
        var TabbedPanelsContent2=document.getElementById("TabbedPanelsContent2");
        
        var TabbedPanelsContent3=document.getElementById("TabbedPanelsContent3");
        if(x==1)
        {
            TabbedPanelsContent1.style.display="block";
            TabbedPanelsContent2.style.display="none";
            TabbedPanelsContent3.style.display="none";
        }
        else if(x==2)
        {
            TabbedPanelsContent1.style.display="none";
            TabbedPanelsContent2.style.display="block";
            TabbedPanelsContent3.style.display="none";
        }
        else if(x==3)
        {
            TabbedPanelsContent1.style.display="none";
            TabbedPanelsContent2.style.display="none";
            TabbedPanelsContent3.style.display="block";
        }
        
        
        var id;
        id="TabbedPanelsTab"+x;
        //alert(id);
        var Change=document.getElementById(id);
        alert(Change.style.backgroundColor);
        if(Change.style.backgroundColor=="rgb(0,0,0)")
        {
            alert("1");
            Change.style.backgroundColor="rgb(87,87,87)";
            alert(Change.style.backgroundColor);
            return 0;
        }
        alert("3");
        if(Change.style.backgroundColor=="rgb(87,87,87)")
        {
            alert("2");
            Change.style.backgroundColor="rgb(0,0,0)";
            alert(Change.style.backgroundColor);
            return 0;
        }
        alert("3");
    } 
    function ChangeTabbedPanelsover(x) 
    {
        var id;
        id="TabbedPanelsTab"+x;
        //alert(id);
        var Change=document.getElementById(id);
        
        Change.style.backgroundColor="rgb(0,0,0)";
        
        var TabbedPanelsContent1=document.getElementById("TabbedPanelsContent1");
        
        var TabbedPanelsContent2=document.getElementById("TabbedPanelsContent2");
        
        var TabbedPanelsContent3=document.getElementById("TabbedPanelsContent3");
        if(x==1)
        {
            TabbedPanelsContent1.style.display="block";
            TabbedPanelsContent2.style.display="none";
            TabbedPanelsContent3.style.display="none";
        }
        else if(x==2)
        {
            TabbedPanelsContent1.style.display="none";
            TabbedPanelsContent2.style.display="block";
            TabbedPanelsContent3.style.display="none";
        }
        else if(x==3)
        {
            TabbedPanelsContent1.style.display="none";
            TabbedPanelsContent2.style.display="none";
            TabbedPanelsContent3.style.display="block";
        }
        
        
    }
    function ChangeTabbedPanelsout(x) 
    {
        var id;
        id="TabbedPanelsTab"+x;
        //alert(id);
        var Change=document.getElementById(id);
        Change.style.backgroundColor="rgb(87,87,87)";
        
    }
    function MenuBarVerticalover(obj)
    {
        var aside_2=document.getElementById("aside_2");
        //alert("123");
        obj.style.backgroundColor="rgb(0,0,0)";
        //alert(obj.style.backgroundColor);
        aside_2.style.marginTop="-87px";
        aside_2.style.display="inline-block";
        
    }  
    function MenuBarVerticalout(obj)
    {
        var aside_2=document.getElementById("aside_2");
        obj.style.backgroundColor="rgb(87,87,87)";
        //alert(obj.style.backgroundColor);
        //setTimeout("aside_2.style.display='none'",3000)
        //aside_2.style.display='none'
    }
    
    
    function accrodion(x)
    {
        //alert("123");
        var ac="accordion-content";
        var ac2=ac+x;
        //alert(ac2);
        var ac3=document.getElementById(ac2);
        //alert(ac3.style.display);
        if(ac3.style.display=="none"){
            ac3.style.display="block";
        }else{
            ac3.style.display="none";
        }
        
    }
    
    
    function Changeimgover(x)
    {
        var hero;
        if(x==1)
        {
            hero="Ashe";
        }
        else if(x==2)
        {
            hero="Garen";
        }
        else if(x==3)
        {
            hero="Ryze";
        }
        
        document.getElementById(hero).src="img/"+hero+"_1.jpg";
        
        
    }
    function Changeimgout(x)
    {
        var hero;
        if(x==1)
        {
            hero="Ashe";
        }
        else if(x==2)
        {
            hero="Garen";
        }
        else if(x==3)
        {
            hero="Ryze";
        }
        
        document.getElementById(hero).src="img/"+hero+"_0.jpg";
        
    }
    
    function onBlurpassword()
    {
        var password=document.getElementById("password").value;
        var password2=document.getElementById("password2").value;
        if((password!=password2)&&password&&password2)
        {
            alert("两个密码不一样");
            myform.password.focus(); 
        }
    }
    function onBluremail()
    {
        
        var email=document.getElementById("email").value;
        var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(email)
        {
            if (filter.test(email)) return true;
            else
            {
                alert("请填写正确的邮箱");
                myform.email.focus(); 
            }
        }
    }
    function toVaild()
    {
        
        
        var nickname=document.getElementById("nickname").value;
        var email=document.getElementById("email").value;
        var password=document.getElementById("password").value;
        var password2=document.getElementById("password2").value;
        
        
        var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        
        if(myform.nickname.value==""){
            alert("请输入呢称"); 
            myform.nickname.focus(); 
            return false; 
        }                
        
        if(myform.email.value==""){
            alert("请输入邮箱"); 
            myform.email.focus(); 
            return false; 
        }   
        if(myform.password.value==""){
            alert("请输入密码"); 
            myform.password.focus(); 
            return false; 
        }   
        if(myform.password2.value==""){
            alert("请确认密码"); 
            myform.password.focus(); 
            return false; 
        }
        if(myform.qm.value==""){
            alert("请输入签名"); 
            myform.qm.focus(); 
            return false; 
        }	
        
        
        
        if(password!=password2)
        {
            alert("两个密码不一样");
            myform.password.focus(); 
            return false; 
        }
        else
        {
            return true;
        }
        
        
        
    }