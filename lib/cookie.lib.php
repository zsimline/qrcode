<?php

require_once 'user.lib.php';

class CookieMan{
    
    private $user;
    private $pr_order_num_1;
    private $pr_order_num_4;
    private $loginstate;
  
    function __construct(){ 
        if(isset($_COOKIE['userid']) && isset($_COOKIE['identification'])){
            $this->user = new User($_COOKIE['userid']);
            $this->user->getUserinfo();
            if($this->user->getIdentification() == $_COOKIE['identification'])
                $this->loginstate = true;
            else 
                $this->loginstate = false;
        }
        else{ 
            return $this->loginstate = false;
       }
    }
    
    function setPrOrderNum1(){
        if(isset($_COOKIE['pr_order_num_1'])){
            $this->pr_order_num_1 = $_COOKIE['pr_order_num_1'];
            $this->user->updateOrderNum1($this->pr_order_num_1);
        }
        else{
            $this->pr_order_num_1 = $this->user->getOrderNum1();
            setcookie("pr_order_num_1", $this->pr_order_num_1 , time() + 365 * 24 * 3600,'/');
        }
    }

    function setPrOrderNum4(){
        if(isset($_COOKIE['pr_order_num_4'])){
            $this->pr_order_num_4 = $_COOKIE['pr_order_num_4'];
            $this->user->updateOrderNum4($this->pr_order_num_4);
        }
        else{
            
            $this->pr_order_num_4 = $this->user->getOrderNum4();
            setcookie("pr_order_num_4", $this->pr_order_num_4 , time() + 365 * 24 * 3600,'/');
        }
    }
    
    function getOrderNum1(){
        return $this->pr_order_num_1;
    }
    
    function getOrderNum4(){
        return $this->pr_order_num_4;
    }
    
    function  getLoginState(){
        return $this->loginstate;
    }
}

?>