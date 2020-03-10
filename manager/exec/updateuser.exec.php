<?php 
    require_once '../../lib/cookie.lib.php';
    require_once '../../lib/user.lib.php';

    /* 管理员身份判断  */
    if(!isset($_COOKIE['userid']) || $_COOKIE['userid']!='2019000000')
        return ;
    
    /* 判断用户登录状态  */
    $cookieman = new CookieMan();
    if(!$cookieman->getLoginState()){
        return ;
    }
    
    execUpdate();

    function execUpdate(){
        $user = new User($_POST['userid']);
        $user->updateUsername($_POST['username']);
        $user->updatePassword($_POST['password']);
        $user->updateEmail($_POST['email']);
    }

?>