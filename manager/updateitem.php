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
    
    if(!isset($_GET['subject']))
        return ;
    else
        $subject = $_GET['subject'];
    $item = new Item($subject);
    $result = $item->getAll(); // 获取全部题目
    
    $garray = array("C"=>"选择题","J"=>"判断题");
    $carray = array("cat1"=>"距离题","cat2"=>"罚款题","cat3"=>"速度题","cat4"=>"标线题","cat5"=>"标志题",
                    "cat6"=>"手势题","cat7"=>"记分题","cat8"=>"灯光题","cat9"=>"仪表题","cat10"=>"路况题");
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
    
    <div id="subselect">
    	<a href="updateitem.php?subject=1">科目一</a>
    	<a href="updateitem.php?subject=4">科目四</a>
    </div>
    
    <div id="container">
    	<?php while($res = $result->fetch()){?>
		<div class="item">
			<span>题目编号: </span><span><?php echo $res['id']?></span>
	 		<span>题目类别: </span><span><?php echo $garray[$res['genre']]?></span>
	 		<span>题目类型: </span><span><?php echo $carray[$res['category']]?></span>
	 		<span>答案: </span><span><?php echo $res['answer']?></span>
	 		<div class="item_content"><span>题目内容: </span><span><?php echo $res['question']?></span></div>
	 		<div class="item_option">
	 			<span>选项A: </span><span><?php echo $res['rA']?></span>
	 			<span>选项B: </span><span><?php echo $res['rB']?></span>
	 			<span>选项C: </span><span><?php echo $res['rC']?></span>
	 			<span>选项D: </span><span><?php echo $res['rD']?></span>
	 		</div>
	 		<div class="item_analyse"><span>题目解析: </span><span><?php echo $res['analyse']?></span></div>
	 		<div class="item_media">
	 			<span>图片地址: </span><span><?php echo $res['urlImg']?></span>
	 			<span>视频地址: </span><span><?php echo $res['urlVideo']?></span>
	 		</div>
	 		<button class="btn" type="button" onclick="showUpdateInfo(this,<?php echo $subject?>,<?php echo $res['id']?>)">修改该题目</button>
		</div>
		<?php } $result=null;?>
    </div>
    
    <div id="update">
    	<p><label>题目编号:</label><input type="text" value="" id="q_id"disabled></p>
    	<p>
    		<label>题目类别:</label>
    		<select id="q_genre">
            	<option value="C">选择题</option>
            	<option value="J">判断题</option>
        	</select>
       	</p>
       	<p>
    		<label>题目类型:</label>
    		<select id="q_category">
            	<option value="cat1">距离题</option>
            	<option value="cat2">罚款题</option>
            	<option value="cat3">速度题</option>
            	<option value="cat4">标线题</option>
            	<option value="cat5">标志题</option>
            	<option value="cat6">手势题</option>
            	<option value="cat7">记分题</option>
            	<option value="cat8">灯光题</option>
            	<option value="cat9">仪表题</option>
            	<option value="cat10">路况题</option>
        	</select>
        </p>
        <p>
    		<label>题目答案:</label>
        	<select id="q_answer">
            	<option value="A">A</option>
            	<option value="B">B</option>
            	<option value="C">C</option>
            	<option value="D">D</option>
            	<option value="T">T</option>
            	<option value="F">F</option>
        	</select>
        </p>
        <label>题目内容: </label><br><textarea id="q_question" value=""></textarea><br>
        <p><label>选项A: </label><input type="text" value="" id="q_optionA"></p>
        <p><label>选项B: </label><input type="text" value="" id="q_optionB"></p>
        <p><label>选项C: </label><input type="text" value="" id="q_optionC"></p>
        <p><label>选项D: </label><input type="text" value="" id="q_optionD"></p>
        <label>题目解释: </label><br><textarea id="q_analyse" value=""></textarea><br>
        <p><label>图片: </label><input type="file" name="img" id="q_img"></p>
        <p><label>视频: </label><input type="file" name="video" id="q_video"></p>
        <button type="button" onclick="updateItem(<?php echo $subject?>)">修改该题目</button>
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