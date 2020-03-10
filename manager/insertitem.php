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
      <a href="deleteitem.php?subject=1">删除题目</a>
      <a href="manuser.php">用户管理</a>
    </nav>
    <div id="container">
      <div id="type1">
        <h2>单选题</h2>
        <p>
          <span>科目</span>
          <select id="c_subject">
            <option value="1">科目一</option>
            <option value="4">科目四</option></select>
        </p>
        <p>
          <span>题目类别</span>
          <select id="c_category">
            <option value="cat1">距离题</option>
            <option value="cat2">罚款题</option>
            <option value="cat3">速度题</option>
            <option value="cat4">标线题</option>
            <option value="cat5">标志题</option>
            <option value="cat6">手势题</option>
            <option value="cat7">记分题</option>
            <option value="cat8">灯光题</option>
            <option value="cat9">仪表题</option>
            <option value="cat10">路况题</option></select>
        </p>
        <p>
          <span>题目描述</span>
          <br>
          <textarea id="c_question"></textarea>
        </p>
        <p>
          <span>题目解释</span>
          <br>
          <textarea id="c_explain"></textarea>
        </p>
        <p>
          <span>选项A</span>
          <input type="text" name="" id="c_optionA"></p>
        <p>
          <span>选项B</span>
          <input type="text" name="" id="c_optionB"></p>
        <p>
          <span>选项C</span>
          <input type="text" name="" id="c_optionC"></p>
        <p>
          <span>选项D</span>
          <input type="text" name="" id="c_optionD"></p>
        <p>
          <span>答案</span>
          <select id="c_answer">
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option></select>
        </p>
        <p>
          <span>图片</span>
          <input type="file" name="img" id="c_img"></p>
        <p>
          <span>视频</span>
          <input type="file" name="video" id="c_video"></p>
        <button type="button" onclick="submitItemC()">提交提目</button></div>
      <div id="type2">
        <h2>判断题</h2>
        <p>
          <span>科目</span>
          <select id="j_subject">/
            <option value="1">科目一</option>
            <option value="4">科目四</option></select>
        </p>
        <p>
          <span>题目类别</span>
          <select id="j_category">
            <option value="cat1">距离题</option>
            <option value="cat2">罚款题</option>
            <option value="cat3">速度题</option>
            <option value="cat4">标线题</option>
            <option value="cat5">标志题</option>
            <option value="cat6">手势题</option>
            <option value="cat7">记分题</option>
            <option value="cat8">灯光题</option>
            <option value="cat9">仪表题</option>
            <option value="cat10">路况题</option></select>
        </p>
        <p>
          <span>题目描述</span>
          <br>
          <textarea id="j_question"></textarea>
        </p>
        <p>
          <span>题目解释</span>
          <br>
          <textarea id="j_explain"></textarea>
        </p>
        <p>
          <span>答案</span>
          <select id="j_answer">
            <option value="T">T</option>
            <option value="F">F</option></select>
        </p>
        <p>
          <span>图片地址</span>
          <input type="file" id="j_img"></p>
        <p>
          <span>视频地址</span>
          <input type="file" id="j_video"></p>
        <button type="button" onclick="submitItemJ()">提交提目</button></div>
    </div>
    <footer>
      <a href="">网站首页</a>
      <a href="">用户须知</a>
      <a href="">隐私协议</a>
      <p>Copyright © 2016-2019 DrivingTest</p>
    </footer>
  </body>

</html>