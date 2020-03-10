<?php 
    require_once '../lib/user.lib.php';
    require_once '../lib/cookie.lib.php';
    require_once '../lib/item.lib.php';

    /* 判断用户登录状态  */
    $cookieman = new CookieMan();
    if(!$cookieman->getLoginState()){
        echo "<script type='text/javascript'>alert('请先登录系统');window.location.href='/DrivingTest/user/login.php'</script>";
        return ;
    }
    
    $user = new User($_COOKIE['userid']);
    
    /* 获取用户信息 */
    $user->getUserinfo();
    $userid = $user->getUserID();
    $username = $user->getUserName();
    $email = $user->getUserEmail();
    $orderNum1 = $user->getOrderNum1();
    $orderNum4 = $user->getOrderNum4();
    $topScore1 = $user->getTopScore1();
    $topScore4 = $user->getTopScore4();
    
    /* 获取考试信息 */
    $examinfo = $user->getExamInfo();
    $examnum = $examinfo->rowCount(); //考试的次数
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>个人中心</title>
	<link rel="stylesheet" type="text/css" href="../resources/css/share.css">
	<link rel="stylesheet" type="text/css" href="../resources/css/user.view.css">
	<script type="text/javascript" src="../resources/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="../resources/js/jquery.cookie.js"></script>
	<script type="text/javascript" src="../resources/js/user.js"></script>
</head>
<body>

	<header>
  		<a href="user.php">个人中心</a>
  		<span onclick="exit()">退出登录</span>
  	</header>

  	<div id="glob">
  		<img alt="" src="../resources/images/share/logo.png">
  		<a href="../practice/practice.php" style="margin-left:66%">回到主页</a>
      <a href="" style="margin-left:15px">最新资讯</a>
  	</div>


  	<div id="left">
  	<div class="info_panel">
  		<h2>个人信息</h2>
  		<ul class="info">
  			<li>账号：<span class="text_info"><?php echo $userid?></span></li>
  			<li>昵称：<span class="text_info"><?php echo $username?></span></li>
  			<li>邮箱：<span class="text_info"><?php echo $email?></span></li>
  			<br>
  			<li>考试次数：<span class="text_info num"><?php echo $examnum?></span></li>
  			<li>科目一最高分数：<span class="text_info num"><?php echo $topScore1?></span></li>
  			<li>科目四最高分数：<span class="text_info num"><?php echo $topScore4?></span></li>
  			<li>科目一练习数量：<span class="text_info num"><?php echo $orderNum1?></span></li>
  			<li>科目四练习数量：<span class="text_info num"><?php echo $orderNum4?></span></li>
  		</ul>
  	</div>
	
	
  		<div class="info_panel">
  			<h2>修改个人信息</h2>
  			<form action="exec/updateinfo.exec.php" method="post">
  				<ul class="info">
  					<li>修改昵称：<input type="text" name="name" class="new_content"></li>
  					<li>修改邮箱：<input type="email" name="email" class="new_content"></li>
  					<li>修改密码：<input type="password" name="pwd" class="new_content"></li>
  					<li>重复密码：<input type="password" name="repwd" class="new_content"></li>
  				</ul>
  				 <button type="submit">提交修改</button>
  			</form>
	  	</div>
  	
  	</div>

  	<div id="right">
  		<h2>历史考试信息</h2>
  		<ul>
  			<?php while($res=$examinfo->fetch()){ ?>
  			<li>
  				<p>科目<span><?php echo $res['subject']=="1"?"一":"四"?></span></p>
  				<p>考试日期：<time><?php echo $res['examTime']?></time></p>
  				<P>考试用时：<time><?php echo $res['useTime']?></time>取得分数：<span style="color:green"><?php echo $res['score']?></span></P>
  				<p> 答对数量：<span class="stat_num"><?php echo $res['tNum']?></span>
  					答错数量：<span class="stat_num"><?php echo $res['fNum']?></span>
  			    	正确率：<span class="stat_num"><?php echo $res['tNum']?>%</span>
  			    </p>
  			</li>
  			<?php }?>
  		</ul>
  	</div>
  	
  	<footer>
      <a href="">网站首页</a>
      <a href="">用户须知</a>
      <a href="">隐私协议</a>
      <p>Copyright © 2016-2019 DrivingTest</p>
    </footer>
</body>
</html>