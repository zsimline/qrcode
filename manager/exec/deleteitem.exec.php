<?php

    require_once '../../lib/cookie.lib.php';
    require_once '../../lib/item.lib.php';

    /* 管理员身份判断  */
    if(!isset($_COOKIE['userid']) || $_COOKIE['userid']!='2019000000')
        return ;

    /* 判断用户登录状态  */
    $cookieman = new CookieMan();
    if(!$cookieman->getLoginState())
        return ;
    
    $subject = $_POST['subject'];
    $id = $_POST['id'];
    
    $item = new Item($subject);
    $item->deleteItem($id);
?>