<?php 
    require_once '../lib/cookie.lib.php';
    require_once '../lib/item.lib.php';

    /* 管理员身份判断  */
    if(!isset($_COOKIE['userid']) || $_COOKIE['userid']!='2019000000')
        echo "<script type='text/javascript'>alert('您无权操作');window.location.href='/DrivingTest/user/login.php'</script>";
    
    /* 判断用户登录状态  */
    $cookieman = new CookieMan();
    if(!$cookieman->getLoginState()){
        echo "<script type='text/javascript'>alert('请先登录系统');window.location.href='/DrivingTest/user/login.php'</script>";
        return ;
    }

?>

<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="utf-8">
    <title>管理员主页</title>
    <link rel="stylesheet" type="text/css" href="../resources/css/share.css"></head>
    <link rel="stylesheet" type="text/css" href="../resources/css/admin.view.css"></head>
    <script type="text/javascript" src="../resources/js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="../resources/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="../resources/js/admin.js"></script>
    <script type="text/javascript">
    	function exit(){
    		$.cookie('userid', '', { expires: -1 , path:'/'});
    		$.cookie('identification', '', { expires: -1 , path:'/'});
    		$.cookie('pr_order_num_1', '', { expires: -1 , path:'/'});
    		$.cookie('pr_order_num_1', '', { expires: -1 , path:'/'});
    		window.location.href = '/DrivingTest/manager/login_admin.php';
    	}
    </script>
  <body>
    <header>
      <a href="admin.php">个人中心</a>
      <span onclick="exit()">退出登录</span>
    </header>
    <div id="glob">
      <img alt="" src="../resources/images/share/logo.png">
      <h1>管理界面</h1></div>
    <nav>
      <a href="selectitem.php?subject=1">查看题目</a>
      <a href="insertitem.php">新增题目</a>
      <a href="updateitem.php?subject=1">修改题目</a>
      <a href="deleteitem.phpsubject=1">删除题目</a>
      <a href="manuser.php">用户管理</a>
    </nav>
    
    <footer>
      <a href="">网站首页</a>
      <a href="">用户须知</a>
      <a href="">隐私协议</a>
      <p>Copyright © 2016-2019 DrivingTest</p>
    </footer>
  </body>

</html>