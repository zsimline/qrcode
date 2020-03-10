<?php

require_once 'database.lib.php';

class User{
    
    private $userid;
    private $username;
    private $password;
    private $identification;
    private $email;
    private $urlTxImg;
    private $orderNum1;
    private $topScore1;
    private $orderNum4;
    private $topScore4;
    private $db;
    
    function __construct($userid = "",$username = ""){
        $this->userid = $userid;
        $this->username = $username;
        $this->db = new Moudle();
    }
      
    function addUser($username,$pwd,$email){
        /* 
        ** 验证此用户名是否可用
        */
        $statement = "select username from userinfo where username='$username'";
        $result = $this->db->executeQuery($statement);
        $uname = $result->fetchColumn();
        if($uname)  return 102;  // 若数据库中已经存在此用户名,返回102（用户名重复）
        $result = null;
        
        /*
        ** 执行插入用户信息 
        */
        $statement = "insert into userinfo (username,password,email) values ('$username','$pwd','$email')";
        $row = $this->db->executeUpdate($statement);
        if($row){
            $statement = "select max(userid) from userinfo";
            $result = $this->db->executeQuery($statement);
            $this->userid = $result->fetchColumn();
            $this->updateIdentification();
            return 101;  // 注册成功,返回101（信息录入成功）
        }
    }
    
    function deleteUser(){
        $statement = "delete from userinfo where userid='$this->userid'";
        $row = $this->db->executeUpdate($statement);
        return $row;
    }
    
    function updateUsername($username){
        $statement = "update userinfo set username='$username' where userid='$this->userid'";
        $row = $this->db->executeUpdate($statement);
        return $row;
    }
    
    function updatePassword($password){
        $statement = "update userinfo set password='$password' where userid='$this->userid'";
        $row = $this->db->executeUpdate($statement);
        $this->updateIdentification();
        return $row;
    }
    
    function updateEmail($email){
        $statement = "update userinfo set email='$email' where userid='$this->userid'";
        $row = $this->db->executeUpdate($statement);
        return $row;
    }
    
    function updateOrderNum1($orderNum1){
        $statement = "update userinfo set orderNum1='$orderNum1' where userid='$this->userid'";
        $row = $this->db->executeUpdate($statement);
        return $row;
    }
    
    function updateOrderNum4($orderNum4){
        $statement = "update userinfo set orderNum4='$orderNum4' where userid='$this->userid'";
        $row = $this->db->executeUpdate($statement);
        return $row;
    }
    
    function updateTopScore1($topScore1){
        $statement = "update userinfo set topScore1='$topScore1' where userid='$this->userid'";
        $row = $this->db->executeUpdate($statement);
        return $row;
    }
    
    function updateTopScore4($topScore4){
        $statement = "update userinfo set topScore4='$topScore4' where userid='$this->userid'";
        $row = $this->db->executeUpdate($statement);
        return $row;
    }
    
    /* 更新认证信息  */
    function updateIdentification(){
        $statement = "select password from userinfo where userid='$this->userid'";
        $result = $this->db->executeQuery($statement);
        
        try {
            $password = $result->fetchColumn();
        } catch (PDOException $e) {
            die ("Error!: " . $e->getMessage() . "<br/>");
        }
    
        $identification = md5($this->userid.$password);
        $statement = "update userinfo set identification='$identification' where userid='$this->userid'";
        $row = $this->db->executeUpdate($statement);
        return $row;
    }
    
    /* 检查用户登录   */
    function check($password){
        $statement = "select userid,password,identification from userinfo where username='$this->username'";
        $result = $this->db->executeQuery($statement);
        
        try {
            $res = $result->fetch();
        } catch (PDOException $e) {
            die ("Error!: " . $e->getMessage() . "<br/>");
        }
        
        $this->userid = $res['userid'];
        $real_password = $res['password'];
        $identification = $res['identification'];
        
        if($real_password){
            if($password==$real_password)
                return $identification; 
            else return 103;  // 密码错误
        } else return 104;  // 用户不存在
    }
    
    function getUserinfo(){
        $statement = "select * from userinfo where userid='$this->userid'";
        $result = $this->db->executeQuery($statement);
        
        try {
            $res = $result->fetch();
        } catch (PDOException $e) {
            die ("Error!: " . $e->getMessage() . "<br/>");
        }
        
        $this->userid = $res['userid'];
        $this->username = $res['username'];
        $this->password = $res['password'];
        $this->identification = $res['identification'];
        $this->email = $res['email'];
        $this->orderNum1 = $res['orderNum1'];
        $this->topScore1 = $res['topScore1'];
        $this->orderNum4 = $res['orderNum4'];
        $this->topScore4 = $res['topScore4'];
    }
    
    function getUserID(){
        return $this->userid;
    }
    
    function getUserName(){
        return $this->username;
    }
    
    function getUserEmail(){
        return $this->email;
    }
    
    function getOrderNum1(){
        return $this->orderNum1;
    }
    
    function getOrderNum4(){
        return $this->orderNum4;
    }
    
    function getTopScore1(){
        return $this->topScore1;
    }
    
    function getTopScore4(){
        return $this->topScore4;
    }
    
    function getIdentification(){
        return $this->identification;
    }
    
    function getExamInfo(){
        $statement = "select * from examinfo where userid='$this->userid'";
        $result = $this->db->executeQuery($statement);
        return $result;
    }
    
    function getAll(){
        $statement = "select * from userinfo";
        $result = $this->db->executeQuery($statement);
        return $result;
    }
}

?>