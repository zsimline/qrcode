<?php

require_once 'database.lib.php';

class Item{
    
    private $id;
    private $genre;
    private $category;
    private $question;
    private $subject;
    private $analyse;
    private $rA;
    private $rB;
    private $rC;
    private $rD;
    private $answer;
    private $urlImg;
    private $urlVideo;

    private $totalSub1;
    private $totalSub4;
    private $totalCatNum; 
    private $db;
    
    function __construct($subject){
        $this->db = new Moudle();
        $this->subject = $subject;
    }
    
    function order($id=1){
        $statement = "select * from subject".$this->subject." where id='".$id."'";
        $result = $this->db->executeQuery($statement);
        
        try {
            $res = $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die ("Error!: " . $e->getMessage() . "<br/>");
        }
        
        $this->assignment($res);
    }
    
    function random(){
        $statement = "select * from subject$this->subject order by rand() limit 1";
        $result = $this->db->executeQuery($statement);

        try {
            $res = $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die ("Error!: " . $e->getMessage() . "<br/>");
        }
        
        $this->assignment($res);
    }
    
    function special($category,$id){
        $st = "set @rownum=0;";  // 设置全局变量
        $this->db->executeQuery($st);
        
        $statement = "select * from (select *,@rownum:=@rownum+1 as i from subject$this->subject where category='$category') as t where i=$id";
        $result = $this->db->executeQuery($statement);

        try {
            $res = $result->fetch(PDO::FETCH_ASSOC);    
        } catch (PDOException $e) {
            die ("Error!: " . $e->getMessage() . "<br/>");
        }
         
        $this->assignment($res);
    }
    
    function getAll(){
        $statement = "select * from subject$this->subject order by id";
        $result = $this->db->executeQuery($statement);
        return $result; 
    }

    function assignment($res){
        $this->id = $res['id'];
        $this->genre = $res['genre'];
        $this->category = $res['category'];
        $this->question = $res['question'];
        $this->analyse = $res['analyse'];
        $this->rA = $res['rA'];
        $this->rB = $res['rB'];
        $this->rC = $res['rC'];
        $this->rD = $res['rD'];
        $this->answer = $res['answer'];
        $this->urlImg = $res['urlImg'];
        $this->urlVideo = $res['urlVideo'];
    }
    
    function setId($id){
        $this->id = $id;
    }
    
    function setGenre($genre){
        $this->genre = $genre;
    }
    
    function setCategory($category){
        $this->category = $category;
    }
    
    function setQuestion($question){
        $this->question = $question;
    }
    
    function setAnalyse($analyse){
        $this->analyse = $analyse;
    }
    
    function setRa($rA){
        $this->rA = $rA;
    }
    
    function setRb($rB){
        $this->rB = $rB;
    }
    
    function setRc($rC){
        $this->rC = $rC;
    }
    
    function setRd($rD){
        $this->rD = $rD;
    }
    
    function setAnswer($answer){
        $this->answer = $answer;
    }
    
    function setUrlImg($urlImg){
        echo $urlImg;
        $this->urlImg = $urlImg;
    }
    
    function setUrlVideo($urlVideo){
        echo $urlVideo;
        $this->urlVideo = $urlVideo;
    }
    
    function getId(){
        return $this->id;
    }
    
    function getGenre(){
        return $this->genre;
    }
    
    function getCategory(){
        return $this->category;
    }
    
    function getQuestion(){
        return $this->question;
    }
    
    function getAnalyse(){
        return $this->analyse;
    }
    
    function getRa(){
        return $this->rA;
    }
    
    function getRb(){
        return $this->rB;
    }
    
    function getRc(){
        return $this->rC;
    }
    
    function getRd(){
        return $this->rD;
    }
    
    function getAnswer(){
        return $this->answer;
    }
    
    function getUrlImg(){
        return $this->urlImg;
    }
    
    function getUrlVideo(){
        return $this->urlVideo;
    }
    
    function insertItem(){
        $statement = "insert into subject$this->subject (genre,category,question,analyse,rA,rB,rC,rD,answer,urlImg,urlVideo) 
                      values ('$this->genre','$this->category','$this->question','$this->analyse','$this->rA','$this->rB','$this->rC','$this->rD','$this->answer','$this->urlImg','$this->urlVideo')";
        $row = $this->db->executeUpdate($statement);
        $statement = "update iteminfo set ".$this->category."Sub"."$this->subject"."=".$this->category."Sub"."$this->subject"."+1";
        $this->db->executeUpdate($statement);
        return $row;
    }
    
    function updateItem(){
        $statement = "update subject$this->subject set genre='$this->genre',category='$this->category',question='$this->question',
                      analyse='$this->analyse',rA='$this->rA',rB='$this->rB',rC='$this->rC',rD='$this->rD',answer='$this->answer'";

        if($this->urlImg)
            $statement = $statement . ",urlImg='$this->urlImg'";
        if($this->urlVideo)
            $statement = $statement . ",urlVideo='$this->urlVideo'";
        $statement = $statement . " where id='$this->id'";
        echo $statement;
        $row = $this->db->executeUpdate($statement);
        return $row;
    }
    
    function deleteItem($id){
        $statement = "select category from subject$this->subject where id='$id'";
        $result = $this->db->executeQuery($statement);
        $this->category = $result->fetchColumn();
        
        $statement = "delete from subject$this->subject where id='$id'";
        $row = $this->db->executeUpdate($statement);
        
        $statement = "update iteminfo set ".$this->category."Sub"."$this->subject"."=".$this->category."Sub"."$this->subject"."-1";
        echo $statement;
        $this->db->executeUpdate($statement);
        
        return $row;
    }
    
    function getTotalSub1(){
        $statement = "select totalSub1 from iteminfo";
        $result = $this->db->executeQuery($statement);
        
        try {
            $this->totalSub1 = $result->fetchColumn();
        } catch (PDOException $e) {
            die ("Error!: " . $e->getMessage() . "<br/>");
        }
        
        return $this->totalSub1;
    }

    function getTotalSub4(){
        $statement = "select totalSub4 from iteminfo";
        $result = $this->db->executeQuery($statement);
        
        try {
            $this->totalSub4 = $result->fetchColumn();
        } catch (PDOException $e) {
            die ("Error!: " . $e->getMessage() . "<br/>");
        }
        
        return $this->totalSub4;
    }
    
    function getCategoryNum1($cat){
        $statement = "select $cat"."Sub1 from iteminfo";
        $result = $this->db->executeQuery($statement);
        
        try {
            $this->totalCatNum1 = $result->fetchColumn();
        } catch (PDOException $e) {
            die ("Error!: " . $e->getMessage() . "<br/>");
        }
        return $this->totalCatNum1;
    }
    
    function getCategoryNum4($cat){
        $statement = "select $cat"."Sub4 from iteminfo";
        $result = $this->db->executeQuery($statement);
        
        try {
            $this->totalCatNum4 = $result->fetchColumn();
        } catch (PDOException $e) {
            die ("Error!: " . $e->getMessage() . "<br/>");
        }
        return $this->totalCatNum4;
    }
}
?>