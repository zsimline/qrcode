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
    
    execUpdate();

    function execUpdate(){
        $item = new Item($_POST['q_subject']);
        $item->setId($_POST['q_id']);
        $item->setGenre($_POST['q_genre']);
        $item->setCategory($_POST['q_category']);
        $item->setAnswer($_POST['q_answer']);
        $item->setQuestion($_POST['q_question']);
        $item->setRa($_POST['q_optionA']);
        $item->setRb($_POST['q_optionB']);
        $item->setRc($_POST['q_optionC']);
        $item->setRd($_POST['q_optionD']);
        $item->setAnalyse($_POST['q_analyse']);

        $item->setUrlImg(uploadImg());
        $item->setUrlVideo(uploadVideo());
        echo $item->updateItem();   //  执行更新
    }
        
    function uploadImg(){
        $file_path = "";
        $file_name = "/DrivingTest/upload_img/".time().".jpg";
        if(isset($_FILES["q_img"])){
            if ((($_FILES["q_img"]["type"] == "image/jpeg")) && ($_FILES["q_img"]["size"] < 1048576)){
            if ($_FILES["q_img"]["error"] > 0){
                echo "上传图片失败";
            }
            else{
                $file_path = $_SERVER['DOCUMENT_ROOT'].$file_name;
                move_uploaded_file($_FILES["q_img"]["tmp_name"],$file_path);
                echo "上传图片成功";
                return $file_name;  
            }
        }
        else{
            echo "您上传了一个非法的图片，图片只能为jpg格式,且小于1M";
        }
    }
   }
   
   function uploadVideo(){
       $file_path = "";
       $file_name = "/DrivingTest/upload_video/".time().".mp4";
       if(isset($_FILES["q_video"])){
           if ((($_FILES["q_video"]["type"] == "video/mp4")) && ($_FILES["q_img"]["size"] < 104857600)){
               if ($_FILES["q_video"]["error"] > 0){
                   echo "上传视频失败";
               }
               else{
                   $file_path = $_SERVER['DOCUMENT_ROOT'].$file_name;
                   move_uploaded_file($_FILES["q_video"]["tmp_name"],$file_path);
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