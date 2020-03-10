<?php
  require '../../lib/user.lib.php';
  
  $user = new User();
  
  /* 获取提交的注册信息 */
  $username = $_POST['usernamesignup'];
  $email = $_POST['emailsignup'];
  $pwd = $_POST['passwordsignup'];
  $repwd = $_POST['passwordsignup_confirm'];
  
  if($pwd == $repwd){       // 验证两次输入的密码是否一致
     $code = $user->addUser($username, $pwd, $email);
     if($code==101)
       echo "<script>alert(\"注册成功，点击后返回登录！！！\");window.location=\"../login.php\"</script>";
     else
       echo "<script>alert(\"注册失败，该用户名已经被其他用户占用了，换一个试试吧！\");history.back()</script>";
  }
  else{
      echo "<script>alert(\"两次输入的密码不一致\");history.back()</script>";
  }
?>