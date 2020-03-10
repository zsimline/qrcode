<?php
  require_once '../../lib/user.lib.php';
  require_once '../../lib/cookie.lib.php';
  require_once '../../lib/item.lib.php';

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
  
  /* 读入用户选择  */
  $answers = array();
  for($i=0;$i<100;$i++){
      if(isset($_POST['answer'.$i]))
      array_push($answers,$i,$_POST['answer'.$i]);
  }
  
  $db = new Moudle();
  $statement = "select examid,examTime,itemids from examinfo where userid='".$_COOKIE['userid']."' order by examTime DESC limit 1";
  $result = $db->executeQuery($statement);
  
  try {
      $res = $result->fetch();
  } catch (PDOException $e) {
      die ("Error!: " . $e->getMessage() . "<br/>");
  }
  
  $itemids = $res['itemids'];
  if($itemids){
      $arr_items = explode('-', $itemids);
  }
  
  $tNum = 0;    // 正确的数量
  $fNum = 0;    // 错误的数量

?>


<!DOCTYPE html>
<html>
   <head>
    <meta charset="utf-8">
    <title>在线练习</title>
    <link rel="stylesheet" tydive="text/css" href="../../resources/css/exam_result.view.css"></head>
  
  <body>
  	<h2 id="rscore" style="text-align:center"></h2>
  	<?php 
       for($i=0;$i<100;$i++){   
           $item->order($arr_items[$i]);
    ?>
    <table>
      <tr>
        <td colspan="4" class="question">
          <span class="ids"><?php echo $i+1 ?></span>
          <span><?php echo $item->getQuestion()?></span></td>
      </tr>
      <tr>
        <td class="option">
          <?php 
            if($item->getRa())
                echo "A. ".$item->getRa();
            else
                echo "正确";
          ?>
        </td>
        <td class="option">
          <?php 
            if($item->getRb())
                echo "B. ".$item->getRb();
            else
                echo "错误";
          ?>        
        </td>
        <td class="option">
          <?php 
            if($item->getRa())
                echo "C. ".$item->getRb();
          ?>        
        
        </td>
        <td class="option">
          <?php 
            if($item->getRa())
                echo "D. ".$item->getRb();
          ?>        
        </td>
      </tr>
      <tr>
        <td class="correct option">正确答案：<?php echo $item->getAnswer();?></td>
        <td class="your option">
          <?php 
        	if(isset($_POST['answer'.$i]))
        	    echo "你的答案：".$_POST['answer'.$i] ;
            else
                echo "没做";
          ?>
        </td>
        <td colspan="2" class="result_t option" style="background-color: 
          <?php  
             if(!isset($_POST['answer'.$i]) || $_POST['answer'.$i] != $item->getAnswer())
                echo "#CC0000;";
             else
                echo "#66CC00;";
          ?>
         ">
          <?php 
          if(!isset($_POST['answer'.$i]) || $_POST['answer'.$i] != $item->getAnswer()){   
              $fNum++;
              echo "错误";
          }
          else{
              $tNum++;
               echo "正确";
          }
          ?>
          </td>
      </tr>
      <tr>
        <td colspan="4" class="explain">题目解释：<?php echo $item->getAnalyse();?></td></tr>
    </table>
    <?php } ?>
    <?php 
    date_default_timezone_set("Asia/Shanghai");  // 设置时区
    $examid = $res['examid'];
    $useTime = gmdate('H:i:s',time() - strtotime($res['examTime']));
    $statement = "update examinfo set useTime='$useTime',tNum='$tNum',fNum='$fNum',score='$tNum' where examid=$examid";
    $db->executeUpdate($statement);
    
    $statement = "select topScore$subject from userinfo where userid='".$_COOKIE['userid']."'";
    $result = $db->executeQuery($statement);
    $topScore = sprintf("%d", $result->fetchColumn());
    if($topScore<$tNum) $topScore = $tNum;
    
    $statement = "update userinfo set topScore$subject = '$topScore' where userid='".$_COOKIE['userid']."'";
    $db->executeUpdate($statement);
    echo "<script>document.getElementById('rscore').innerHTML='模拟测试分数:  $tNum 分 &nbsp;&nbsp;&nbsp;&nbsp; 考试用时:  $useTime'</script>";
    ?>
    
  </body>

</html>