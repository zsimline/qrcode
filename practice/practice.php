<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="utf-8">
    <title>在线练习</title>
    <link rel="stylesheet" href="../resources/css/share.css" />
    <link rel="stylesheet" type="text/css" href="../resources/css/practice.view.css">
    <script type="text/javascript" src="../resources/js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="../resources/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="../resources/js/user.js"></script>
  </head>
  
  <body>
    <header>
      <a href="../user/user.php">个人中心</a>
      <span onclick="exit()">退出登录</span>
    </header>
    <div id="glob">
      <img alt="" src="../resources/images/share/logo.png">
      <a href="practice.php" style="margin-left:66%">回到主页</a>
      <a href="" style="margin-left:15px">最新资讯</a></div>
    <div class="subject">
      <h2>科目一</h2>
      <a href="order.php?subject=1" class="blocks">
        <img src="../resources/images/share/order.svg">
        <h5>顺序练习</h5></a>
      <a href="random.php?subject=1" class="blocks">
        <img src="../resources/images/share/random.svg">
        <h5>随机练习</h5></a>
      <a href="special.php?subject=1" class="blocks">
        <img src="../resources/images/share/category.svg">
        <h5>专项练习</h5></a>
      <a href="exam.php?subject=1" class="blocks">
        <img src="../resources/images/share/exam.svg">
        <h5>模拟考试</h5></a>
    </div>
    <div class="subject">
      <h2>科目四</h2>
      <a href="order.php?subject=4" class="blocks">
        <img src="../resources/images/share/order.svg">
        <h5>顺序练习</h5></a>
      <a href="random.php?subject=4" class="blocks">
        <img src="../resources/images/share/random.svg">
        <h5>随机练习</h5></a>
      <a href="special.php?subject=4" class="blocks">
        <img src="../resources/images/share/category.svg">
        <h5>专项练习</h5></a>
      <a href="exam.php?subject=4" class="blocks">
        <img src="../resources/images/share/exam.svg">
        <h5>模拟考试</h5></a>
    </div>
   
   <footer>
      <a href="">网站首页</a>
      <a href="">用户须知</a>
      <a href="">隐私协议</a>
      <p>Copyright © 2016-2019 DrivingTest</p>
    </footer>
  </body>

</html>