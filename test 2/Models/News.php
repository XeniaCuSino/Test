<?php 
class myNews{
    private $id='';
    private $title='';
    private $an_nt='';
    private $text='';
    private $tags='';
    private $date='';
    public function __construct($title, $an_nt, $text, $tags){
        $this->id=uniqid('nws');
        $this->title=$title;
        $this->an_nt=$an_nt;
        $this->text=$text;
        $this->tags=$tags;
        $date = new DateTime('NOW');
        $this->date = $date->format('d.m.Y H:i:s');
    }
    function getId(){
        return $this->id;
    }
    function getTitle(){
        return $this->title;
    }
    function getAn_nt(){
        return $this->an_nt;
    }
    function getText(){
        return $this->text;
    }
    function getTags(){
        return $this->tags;
    }
    function getDate(){
        return $this->date;
    }
    function setTitle($title){
        $this->title=$title;
    }
    function setAn_nt($an_nt){
        $this->an_nt=$an_nt;
    }
    function setText($text){
        $this->text=$text;
    }
    function setTags($tags){
        $this->tags=$tags;
    }
    function createNews($cnct){
        $cnct->query("INSERT INTO `table` (`id`,`title`,`anons`,`text`,`tags`,`date`) VALUES ('".$this->id."','".$this->title."','".$this->an_nt."','".$this->text."','".$this->tags."','".$this->date."');");
    }
    function selectNewsById($cnct, $id){
        $res = $cnct->query("SELECT * FROM `table` WHERE `id`='".$id."';");
        if($res -> num_rows == 1){
            $rec = $res -> fetch_assoc();
            $this->id=$rec['id'];
            $this->title=$rec['title'];
            $this->an_nt=$rec['anons'];
            $this->text=$rec['text'];
            $this->tags=$rec['tags'];
            $this->date = $rec['date'];
            return true;
        }
        else{
            return false;
        }
    }
    function selectNewsByTitle($cnct, $q){
        $res = $cnct->query("SELECT * FROM `table` WHERE `title` LIKE '".$q."%';");
        if($res -> num_rows == 1){
            $rec = $res -> fetch_assoc();
            $this->id=$rec['id'];
            $this->title=$rec['title'];
            $this->an_nt=$rec['anons'];
            $this->text=$rec['text'];
            $this->tags=$rec['tags'];
            $this->date = $rec['date'];
            return true;
        }
        else{
            return false;
        }
    }
    function deleteNews($cnct){
        $cnct->query("DELETE FROM `table` WHERE `id`='".$this->id."';");
    }
}
?>