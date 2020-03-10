<?php
    require_once '../lib/cookie.lib.php';
    require_once '../lib/user.lib.php';

    /* 管理员身份判断  */
    if(!isset($_COOKIE['userid']) || $_COOKIE['userid']!='2019000000')
        echo "<script type='text/javascript'>alert('您无权操作');window.location.href='/DrivingTest/user/login.php'</script>";
    
    /* 判断用户登录状态  */
    $cookieman = new CookieMan();
    if(!$cookieman->getLoginState()){
        echo "<script type='text/javascript'>alert('请先登录系统');window.location.href='/DrivingTest/user/login.php'</script>";
        return ;
    }
    
    $item = new User();
    $result = $item->getAll(); // 获取全部题目
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
      <a href="deleteitem.php?subject=1">删除题目</a>
      <a href="manuser.php">用户管理</a>
    </nav>
        
    <div id="container">
    	<?php while($res = $result->fetch()){?>
		<div class="item">
			<span>ID: </span><span><?php echo $res['userid']?></span>
	 		<span>用户名: </span><span><?php echo $res['username']?></span>
	 		<span>密码: </span><span><?php echo $res['password']?></span>
	 		<span>邮箱: </span><span><?php echo $res['email']?></span>
	 		<button class="btn" type="button" onclick="deleteUser(this,<?php echo $res['userid']?>)">删除该用户</button>
	 		<button class="btn" type="button" onclick="showUpdateUserInfo(this,<?php echo $res['userid']?>)">修改该用户</button>
		</div>
		<?php } $result=null;?>
    </div>

    <div id="update">
    	<p><label>ID:</label><input type="text" value="" id="u_id" disabled></p>
        <p><label>用户名: </label><input type="text" value="" id="u_name"></p>
        <p><label>密码: </label><input type="text" value="" id="u_pwd"></p>
        <p><label>邮箱: </label><input type="email" value="" id="u_email"></p>
        <button type="button" onclick="updateUser()">修改该题目</button>
        <button type="button" onclick="closeInfo()">关闭</button>
    </div>
    
    <footer>
      <a href="">网站首页</a>
      <a href="">用户须知</a>
      <a href="">隐私协议</a>
      <p>Copyright © 2016-2019 DrivingTest</p>
    </footer>
  </body>

</html>