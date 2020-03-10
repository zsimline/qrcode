<!DOCTYPE HTML>
<html>
 <head>
  <meta charset="UTF-8" /> 
  <title>用户登录</title>
  <link rel="stylesheet" type="text/css" href="../resources/css/demo.css" />
  <link rel="stylesheet" type="text/css" href="../resources/css/login.view.css" />
  <link rel="stylesheet" type="text/css" href="../resources/css/animate-custom.css" /> 
 </head>
 
 <body>
  <div class="container"> 
   <section> 
    <div id="container_demo"> 
     <a class="hiddenanchor" id="toregister"></a> 
     <a class="hiddenanchor" id="tologin"></a> 
     <div id="wrapper"> 
      <div id="login" class="animate form"> 
       <form action="exec/login.exec.php" method="post" autocomplete="on"> 
        <h1>登录</h1> 
        <p> <input id="username" name="username" required="required" type="text" placeholder="用户名" /> </p> 
        <p> <input id="password" name="password" required="required" type="password" placeholder="密码" /> </p> 
        <p class="keeplogin"> <input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" /> <label for="loginkeeping">记住密码</label> </p> 
        <p class="login button"> <input type="submit" value="登录" /> </p> 
        <p class="change_link">还没有账号? <a href="./login.php#toregister" class="to_register">注册账号</a><a href="../manager/login_admin.php">管理员登录</a></p> 
       </form> 
      </div> 
      <div id="register" class="animate form"> 
       <form action="exec/register.exec.php" method="post" autocomplete="on"> 
        <h1> 注册 </h1> 
        <p> <label for="usernamesignup" class="uname" data-icon="u"> 您的昵称 </label> <input id="usernamesignup" name="usernamesignup" required="required" type="text" placeholder="username" /> </p> 
        <p> <label for="emailsignup" class="youmail" data-icon="e"> 您的邮箱 </label> <input id="emailsignup" name="emailsignup" required="required" type="email" placeholder="email" /> </p> 
        <p> <label for="passwordsignup" class="youpasswd" data-icon="p"> 请输入密码 </label> <input id="passwordsignup" name="passwordsignup" required="required" type="password" placeholder="password" /> </p> 
        <p> <label for="passwordsignup_confirm" class="youpasswd" data-icon="p"> 请再次输入密码 </label> <input id="passwordsignup_confirm" name="passwordsignup_confirm" required="required" type="password" placeholder="repassword	" /> </p> 
        <p class="signin button"> <input type="submit" value="注册" /> </p> 
        <p class="change_link"> 已经有账号了 ? <a href="./login.php#tologin" class="to_register"> 马上登录 </a> </p> 
       </form>
      </div>
     </div> 
    </div> 
   </section> 
  </div> 
 </body>
</html>