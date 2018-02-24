<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>查询手机归属地</title>
  </head>
  <link href="style.css" rel="stylesheet" type="text/css" media="all"/>
  <script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://cdn.staticfile.org/sweetalert/1.1.3/sweetalert-dev.min.js"></script>
  <link href="https://cdn.staticfile.org/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet">
  <script src="https://cdn.staticfile.org/sweetalert/1.1.3/sweetalert.min.js"></script>
  <!--Google Fonts-->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
  <!--Google Fonts-->
  <body>
    <!--search start here-->
    <div class="search">
    	<i> </i>
    	<div class="s-bar">
    	   <form action=""  enctype="multipart/form-data">
    		<input id="phone" name="phoneNum" type="text"  value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '查询手机归属地';}">
    		<input type="button" onClick="sub()" value="Search"/>
    	  </form>
    	</div>
      <p id="zone">&nbsp;</p>
    </div>
  </body>
  <script type="text/javascript">
     function sub(){
    var regu = /^1[0-9]{10}$/;
    var phoneNum = document.getElementById('phone').value;
    // alert(phoneNum);
    var reg = new RegExp(regu);
    //通过手机号正则表达式来进行验证输入的是否为手机号码
    var flag = reg.test(phoneNum);
    if(flag == true){
      var xmlhttp;
      if (window.XMLHttpRequest)
      {
          //  IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
          xmlhttp=new XMLHttpRequest();
      }
      else
      {
          // IE6, IE5 浏览器执行代码
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange=function()
      {
          if (xmlhttp.readyState==4 && xmlhttp.status==200)
          {
              //把服务器传回的值赋给变量msg
              eval('var data = '+ xmlhttp.responseText);
              // console.log(data);
              var s=data['phone']+'('+data['operators']+')号码归属地在：'+data['style_citynm'];
              document.getElementById('zone').innerHTML = s;
          }
      }
      xmlhttp.open("GET","SearchController.php?phoneNum="+phoneNum,true);
      xmlhttp.send();
    }else{
      alert('请输入正确的手机号码');
    }

  }
  </script>
</html>
