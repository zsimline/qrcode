<?php 
    require_once '../../lib/cookie.lib.php';
    require_once '../../lib/item.lib.php';

    /* 管理员身份判断  */
    if(!isset($_COOKIE['userid']) || $_COOKIE['userid']!='2019000000')
        return ;
    
    /* 判断用户登录状态  */
    $cookieman = new CookieMan();
    if(!$cookieman->getLoginState()){
        return ;
    }
    
    if($_POST['genre'] == 'C')
        insertChoose();
    else
        insertJump();

    function insertChoose(){
        $item = new Item($_POST['c_subject']);
        $item->setGenre($_POST['genre']);
        $item->setCategory($_POST['c_category']);
        $item->setQuestion($_POST['c_question']);
        $item->setAnalyse($_POST['c_explain']);
        $item->setRa($_POST['c_optionA']);
        $item->setRb($_POST['c_optionB']);
        $item->setRc($_POST['c_optionC']);
        $item->setRd($_POST['c_optionD']);
        $item->setAnswer($_POST['c_answer']);
        $item->setUrlImg(uploadImgC());
        $item->setUrlVideo(uploadVideoC());
        echo $item->insertItem();   //  执行插入
    }
    
    function insertJump(){
        $item = new Item($_POST['j_subject']);
        $item->setGenre($_POST['genre']);
        $item->setCategory($_POST['j_category']);
        $item->setQuestion($_POST['j_question']);
        $item->setAnalyse($_POST['j_explain']);
        $item->setAnswer($_POST['j_answer']);
        $item->setUrlImg(uploadImgJ());
        $item->setUrlVideo(uploadVideoJ());
        echo $item->insertItem();   //  执行插入
    }
    
    function uploadImgC(){
        $file_path = "";
        $file_name = "/DrivingTest/upload_img/".time().".jpg";
        if(isset($_FILES["c_img"])){
            if ((($_FILES["c_img"]["type"] == "image/jpeg")) && ($_FILES["c_img"]["size"] < 1048576)){
            if ($_FILES["c_img"]["error"] > 0){
                echo "上传图片失败";
            }
            else{
                $file_path = $_SERVER['DOCUMENT_ROOT'].$file_name;
                move_uploaded_file($_FILES["c_img"]["tmp_name"],$file_path);
                echo "上传图片成功";
                return $file_name;  
            }
        }
        else{
            echo "您上传了一个非法的图片，图片只能为jpg格式,且小于1M";
        }
    }
   }
   
   function uploadVideoC(){
       $file_path = "";
       $file_name = "/DrivingTest/upload_video/".time().".mp4";
       if(isset($_FILES["c_video"])){
           if ((($_FILES["c_video"]["type"] == "video/mp4")) && ($_FILES["c_img"]["size"] < 104857600)){
               if ($_FILES["c_video"]["error"] > 0){
                   echo "上传视频失败";
               }
               else{
                   $file_path = $_SERVER['DOCUMENT_ROOT'].$file_name;
                   move_uploaded_file($_FILES["c_video"]["tmp_name"],$file_path);
                   echo "上传视频成功";
                   return $file_name;
               }
           }
           else{
               echo "您上传了一个非法的视频，视频只能为mp4格式,且小于10M";
           }
       }
   }
   
   function uploadImgJ(){
       $file_path = "";
       $file_name = "/DrivingTest/upload_img/".time().".jpg";
       if(isset($_FILES["j_img"])){ echo "aa";
           if ((($_FILES["j_img"]["type"] == "image/jpeg")) && ($_FILES["j_img"]["size"] < 1048576)){
               if ($_FILES["j_img"]["error"] > 0){
                   echo "上传图片失败";
               }
               else{
                   $file_path = $_SERVER['DOCUMENT_ROOT'].$file_name;
                   move_uploaded_file($_FILES["j_img"]["tmp_name"],$file_path);
                   echo "上传图片成功";
                   return $file_name;
               }
           }
           else{
               echo "您上传了一个非法的图片，图片只能为jpg格式,且小于1M";
           }
       }
   }
   
   function uploadVideoJ(){
       $file_path = "";
       $file_name = "/DrivingTest/upload_video/".time().".mp4";
       if(isset($_FILES["j_video"])){
           if ((($_FILES["j_video"]["type"] == "video/mp4")) && ($_FILES["j_img"]["size"] < 104857600)){
               if ($_FILES["j_video"]["error"] > 0){
                   echo "上传视频失败";
               }
               else{
                   $file_path = $_SERVER['DOCUMENT_ROOT'].$file_name;
                   move_uploaded_file($_FILES["j_video"]["tmp_name"],$file_path);
                   echo "上传视频成功";
                   return $file_name;
               }
           }
           else{
               echo "您上传了一个非法的视频，视频只能为mp4格式,且小于10M";
           }
       }
   }
    
?>