<?php
  require_once '../../lib/user.lib.php';
  
  if(isset($_POST['username']) && isset($_POST['password'])){
      $user = new User("",$_POST['username']);
      $code = $user->check($_POST['password']);
      
      switch ($code) {
          case 104:{
              echo "<script>alert(\"无此用户\");history.back();</script>";
              break;
          }
          case 103:{
              echo "<script>alert(\"密码错误\");history.back();</script>";
              break;
          }
          default:{
              setcookie("userid", $user->getUserID() , time()+360000,'/');
              setcookie("identification", $code , time()+360000,'/');
              if($_POST['username']!="admin")
                header("Location: ../../practice/practice.php");    // 普通用户跳转到练习界面
              else
                header("Location: ../../manager/admin.php");     // 管理员跳转到管理界面
              break;
          }
      }
  }
?>