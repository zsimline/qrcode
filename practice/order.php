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
      $totalSub = $item->getTotalSub1();
      $cookieman->setPrOrderNum1();  //同步科目一做题的数量
      $orderNum = $cookieman->getOrderNum1();   
  }else{
      $totalSub = $item->getTotalSub4();
      $cookieman->setPrOrderNum4();  //同步科目四做题的数量
      $orderNum = $cookieman->getOrderNum4();
  }
  
  $item->order($orderNum);  //从数据库取题
 
  if($item->getUrlImg())
    $urlFrame = $item->getUrlImg();
  elseif($item->getUrlVideo())
    $urlFrame = $item->getUrlVideo();
  else
    $urlFrame = "";
    
  $category = null;
  switch($item->getCategory()){
      case "cat1":$category = "距离题"; break;
      case "cat2":$category = "罚款题"; break;
      case "cat3":$category = "速度题"; break;
      case "cat4":$category = "标线题"; break;
      case "cat5":$category = "标志题"; break;
      case "cat6":$category = "手势题"; break;
      case "cat7":$category = "记分题"; break;
      case "cat8":$category = "灯光题"; break;
      case "cat9":$category = "仪表题"; break;
      case "cat10":$category = "路况题"; break;
  }
  
  if($item->getGenre()=="C"){
      $display_c = "block";
      $display_j = "none";
  }else{
      $display_c = "none";
      $display_j = "block";
  }
  
?>

<!DOCTYPE HTML>
<html>
  
  <head>
    <meta charset="UTF-8" />
    <title>顺序练习</title>
    <link rel="stylesheet" href="../resources/css/share.css" />
    <link rel="stylesheet" href="../resources/css/order.view.css" />
    <script type="text/javascript" src="../resources/js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="../resources/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="../resources/js/order.js"></script>
    <script type="text/javascript" src="../resources/js/fetch.js"></script>
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
      <a href="" style="margin-left:15px">最新资讯</a>
  	</div>

    <nav>
      <a href="practice.php">首页</a> &gt;
      <a href="order.php?subject=<?php echo $subject?>">顺序练习</a>
    </nav>
  
    <div id="panel">
      <div>
        <span id="type">顺序练习</span>
        <span class="describe">类别：<?php echo $category ?></span>
        <span class="describe">科目：科目<?php echo $subject==1?"一":"四"; ?></span></div>
      <div id="container">
        <div id="bookmark" data-content="<?php echo $item->getId() ?>/<?php echo $totalSub ?>"></div>
        <div id="left">
          <p id="question"><?php echo $item->getQuestion()?></p>
          <ul id="answer"> 
            <li class="choose" style="display:<?php echo $display_c?>">
           	  <input type="radio" id="option1" name="annswer" onclick="approval('A')">
              	A:&nbsp;<label for="option1"><?php echo $item->getRa() ?></label></li>
            <li class="choose" style="display:<?php echo $display_c?>">
              <input type="radio" id="option2" name="annswer" onclick="approval('B')">
              	B:&nbsp;<label for="option2"><?php echo $item->getRb() ?></label></li>
            <li class="choose" style="display:<?php echo $display_c?>">
              <input type="radio" id="option3" name="annswer" onclick="approval('C')">
              	C:&nbsp;<label for="option3"><?php echo $item->getRc() ?></label></li>
            <li class="choose" style="display:<?php echo $display_c?>">
              <input type="radio" id="option4" name="annswer" onclick="approval('D')">
              	D:&nbsp;<label for="option4"><?php echo $item->getRd() ?></label></li>
            <li class="judge" style="display:<?php echo $display_j?>">
              <input type="radio" id="option5" name="annswer" onclick="approval('T')">
              <label for="option5">正确</label></li>
            <li class="judge" style="display:<?php echo $display_j?>">
              <input type="radio" id="option6" name="annswer" onclick="approval('F')">
              <label for="option6">错误</label></li>
          </ul>
          <p id="result"></p>
          <div id="button_group">
            <button type="button" onclick="fetchPrev()">上一题</button>
            <button type="button" onclick="fetchNext()">下一题</button>
          </div>
          <p id="answer" style="display:none"><?php echo $item->getAnswer() ?></p>
          <div id="explain">
          	<h4>习题解析</h4>
          	<p id="explain_content"><?php echo $item->getAnalyse() ?></p>
          </div>
          <div>
            <span>答对：</span>
            <span class="stst" style="color:green">0</span>
            <span>答错：</span>
            <span class="stst" style="color:red">0</span>
            <span>正确率：</span>
            <span class="stst" style="color:blue">0%</span>
            <input type="checkbox" id="autonext" />
            <span>答对后自动跳转到下一题</span></div>
        </div>
        <div id="right">
          <iframe src = "<?php echo $urlFrame ?>" frameborder="0" scrolling="no" seamless></iframe>
        </div>
      </div>
    </div>

    <footer>
      <a href="">网站首页</a>
      <a href="">用户须知</a>
      <a href="">隐私协议</a>
      <p>Copyright © 2016-2019 DrivingTest</p>
    </footer>

  </body>
</html>