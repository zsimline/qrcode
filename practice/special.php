<?php
  require_once '../lib/user.lib.php';
  require_once '../lib/cookie.lib.php';
  require_once '../lib/item.lib.php';

  $user = new User();
  $cookieman = new CookieMan();

  if(!$cookieman->getLoginState()){
      echo "<script type='text/javascript'>alert('请先登录系统');window.location.href='/DrivingTest/user/login.php'</script>";
      return ;
  }
  
  if(isset($_GET['subject'])){
      $subject = $_GET['subject'];
      $item = new Item($subject);
  }
  else return ;
  
  /* ...... */
  if($subject=="1"){
      $topSub = $item->getTotalSub1();
      $cookieman->setPrOrderNum1();  //同步科目一做题的数量
      $orderNum = $cookieman->getOrderNum1();   
  }else{
      $topSub = $item->getTotalSub4();
      $cookieman->setPrOrderNum4();  //同步科目四做题的数量
      $orderNum = $cookieman->getOrderNum4();
  }

?>

<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="utf-8">
    <title>在线练习</title>
    <link rel="stylesheet" tydive="text/css" href="../resources/css/share.css"></head>
    <link rel="stylesheet" tydive="text/css" href="../resources/css/special.view.css"></head>
    <script type="text/javascript" src="../resources/js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="../resources/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="../resources/js/user.js"></script>
  <body>
    <header>
      <a href="../user/user.php">个人中心</a>
      <span onclick="exit()">退出登录</span>
    <div id="glob">
      <img alt="" src="../resources/images/share/logo.png">
      <a href="practice.php" style="margin-left:66%">回到主页</a>
      <a href="" style="margin-left:15px">模拟测试</a></div>

    <h2>专项练习</h2>
    <div id="container">
    	<a href="specials.php?subject=<?php echo $subject?>&cat=cat1">距离题 </a>
    	<a href="specials.php?subject=<?php echo $subject?>&cat=cat2">罚款题 </a>
    	<a href="specials.php?subject=<?php echo $subject?>&cat=cat3">速度题 </a>
    	<a href="specials.php?subject=<?php echo $subject?>&cat=cat4">标线题 </a>
    	<a href="specials.php?subject=<?php echo $subject?>&cat=cat5">标志题 </a>
    	<a href="specials.php?subject=<?php echo $subject?>&cat=cat6">手势题 </a>
    	<a href="specials.php?subject=<?php echo $subject?>&cat=cat7">记分题 </a>
    	<a href="specials.php?subject=<?php echo $subject?>&cat=cat8">灯光题 </a>
    	<a href="specials.php?subject=<?php echo $subject?>&cat=cat9">仪表题 </a>
    	<a href="specials.php?subject=<?php echo $subject?>&cat=cat10">路况题</a>
    </div>

   <footer>
      <a href="">网站首页</a>
      <a href="">用户须知</a>
      <a href="">隐私协议</a>
      <p>Copyright © 2016-2019 DrivingTest</p>
    </footer>
  </body>

</html>