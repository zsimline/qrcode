<?php
 
  require '../../lib/item.lib.php';
  
  header('Content-type:text/json'); 
  
  if(isset($_POST['subject']))
      $subject = $_POST['subject'];
  else return ;
  if(isset($_POST['type']))
      $type = $_POST['type'];
  else return ;
  
  $item = new Item($subject);

  switch ($type){
      case "order":{
          if(isset($_POST['id']))        
              $id = $_POST['id'];
          else return ;
     
          $item->order($id);
          break;
      }
      case "random":{
          $item->random();
          break;
      }
      case "special":{
          if(isset($_POST['category']))
              $category = $_POST['category'];
              else return ;
          if(isset($_POST['id']))
              $id = $_POST['id'];
          else return ;
     
          $item->special($category, $id);
          break;
      }
  }
  
  $arr = array(
      "id" => $item->getId(),
      "genre" => $item->getGenre(),
      "category" => $item->getCategory(), 
      "question" => $item->getQuestion(), 
      "analyse" => $item->getAnalyse(),
      "rA" => $item->getRa(),
      "rB" => $item->getRb(),
      "rC" => $item->getRc(),
      "rD" => $item->getRd(),
      "answer" => $item->getAnswer(),
      "urlImg" => $item->getUrlImg(),
      "urlVideo" => $item->getUrlVideo()
   );

  echo json_encode($arr);
?>