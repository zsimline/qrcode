<!DOCTYPE html>
<html>
 <head> 
  <meta charset="UTF-8" /> 
  <title>用户登录</title> 
  <link rel="stylesheet" type="text/css" href="../resources/css/demo.css" /> 
  <link rel="stylesheet" type="text/css" href="../resources/css/login.view.css" />
 </head> 
 
 <body style="background: #fff url(../resources/images/share/bg.admin.jpg) no-repeat 100%;"> 
  <div class="container"> 
   <section> 
    <div id="container_demo"> 
     <a class="hiddenanchor" id="toregister"></a> 
     <a class="hiddenanchor" id="tologin"></a> 
     <div id="wrapper"> 
      <div id="login" class="animate form"> 
       <form action="../user/exec/login.exec.php" method="post" autocomplete="on"> 
        <h1>管理员登录</h1> 
        <p> <input id="username" name="username" required="required" type="text" placeholder="管理员账号" /></p> 
        <p> <input id="password" name="password" required="required" type="password" placeholder="管理员密码" /></p> 
        <p class="keeplogin"> <input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" /> <label for="loginkeeping">记住密码</label></p> 
        <p class="login button"> <input type="submit" value="登录" /></p> 
       </form> 
      </div> 
     </div> 
    </div> 
   </section> 
  </div>  
 </body>
</html>