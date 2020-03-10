<?php
    require_once '../../lib/user.lib.php';
    require_once '../../lib/cookie.lib.php';
    require_once '../../lib/item.lib.php';

    /* 判断用户登录状态  */
    $cookieman = new CookieMan();
    if(!$cookieman->getLoginState()){
        echo "<script type='text/javascript'>alert('请先登录系统');window.location.href='/DrivingTest/user/login_student.php'</script>";
        return ;
    }

    $user = new User($_COOKIE['userid']);
    
    /* 修改用户昵称  */
    if(isset($_POST['name']) && $_POST['name']!=""){
        $row = $user->updateUsername($_POST['name']);
        if(!$row){
            echo "<script type='text/javascript'>alert('修改昵称失败');history.back()</script>";
            return ;
        }
    }
    
    /* 修改用户邮箱 */
    if(isset($_POST['email']) && $_POST['email']!=""){
        $row = $user->updateEmail($_POST['email']);
        if(!$row){
            echo "<script type='text/javascript'>alert('修改邮箱失败');history.back()</script>";
            return ;
        }
    }
    
    /* 修改用户密码  */
    if(isset($_POST['pwd']) && isset($_POST['repwd']) && $_POST['pwd']!="" && $_POST['repwd']!=""){
        if($_POST['pwd'] != $_POST['repwd']){
            echo "<script type='text/javascript'>alert('两次输入的密码不一致');history.back()</script>";
            return ;
        }
        $row = $user->updatePassword($_POST['pwd']);
        if(!$row){
            echo "<script type='text/javascript'>alert('修改密码失败');history.back()</script>";
            return ;
        }
    }

    echo "<script type='text/javascript'>alert('修改个人信息成功');history.back()</script>";
    
?>